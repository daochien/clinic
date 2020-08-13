<?php

namespace Frameworks\Cores\Repositories;

use Closure;
use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Frameworks\Cores\Interfaces\RepositoryInterface;
use Frameworks\Cores\Exceptions\RepositoryException;
use Frameworks\Cores\Interfaces\ValidatorInterface;
use Frameworks\Cores\Interfaces\PresenterInterface;
use Frameworks\Cores\Interfaces\CriteriaInterface;
use Illuminate\Support\Facades\DB;

class BaseRepository implements RepositoryInterface
{
    protected $app;

    protected $model;

    protected $fieldSearchable = array();

    protected $presenter;

    protected $validator;

    protected $rules = null;

    protected $criteria;

    protected $skipCriteria = false;

    protected $skipPresenter = false;

    protected $scopeQuery = null;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->criteria = new Collection();
        $this->makeModel();
        $this->makePresenter();
        $this->makeValidator();
        $this->boot();
    }

    public function boot()
    {
    }

    public function resetModel()
    {
        $this->makeModel();
    }

    public function presenter()
    {
        return null;
    }

    public function validator()
    {

        if (isset($this->rules) && !is_null($this->rules) && is_array($this->rules) && !empty($this->rules)) {
            if (class_exists('Frameworks\Cores\Validators\LaravelValidator')) {
                $validator = app('Frameworks\Cores\Validators\LaravelValidator');
                if ($validator instanceof ValidatorInterface) {
                    $validator->setRules($this->rules);
                    return $validator;
                }
            } else {
                throw new Exception(trans('repository::packages.laravel_validation_required'));
            }
        }

        return null;
    }

    public function setPresenter($presenter)
    {
        $this->makePresenter($presenter);
        return $this;
    }

    public function makeModel()
    {
        // $model = $this->app->make($this->model());

        // if (!$model instanceof Model) {
        //     throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        // }

        // return $this->model = $model;

        return $this->model;
    }

    public function makePresenter($presenter = null)
    {
        $presenter = !is_null($presenter) ? $presenter : $this->presenter();

        if (!is_null($presenter)) {
            $this->presenter = is_string($presenter) ? $this->app->make($presenter) : $presenter;

            if (!$this->presenter instanceof PresenterInterface) {
                throw new RepositoryException("Class {$presenter} must be an instance of Prettus\\Repository\\Contracts\\PresenterInterface");
            }

            return $this->presenter;
        }

        return null;
    }

    public function makeValidator($validator = null)
    {
        $validator = !is_null($validator) ? $validator : $this->validator();

        if (!is_null($validator)) {
            $this->validator = is_string($validator) ? $this->app->make($validator) : $validator;

            if (!$this->validator instanceof ValidatorInterface) {
                throw new RepositoryException("Class {$validator} must be an instance of Prettus\\Validator\\Contracts\\ValidatorInterface");
            }

            return $this->validator;
        }

        return null;
    }

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function scopeQuery(\Closure $scope)
    {
        $this->scopeQuery = $scope;
        return $this;
    }

    public function lists($column, $key = null)
    {
        $this->applyCriteria();
        return $this->model->lists($column, $key);
    }

    public function pluck($column, $key = null)
    {
        $this->applyCriteria();
        return $this->model->pluck($column, $key);
    }

    public function sync($id, $relation, $attributes, $detaching = true)
    {
        return $this->find($id)->{$relation}()->sync($attributes, $detaching);
    }

    public function syncWithoutDetaching($id, $relation, $attributes)
    {
        return $this->sync($id, $relation, $attributes, false);
    }

    public function all($columns = array('*'))
    {
        $this->applyCriteria();
        $this->applyScope();

        if ($this->model instanceof \Illuminate\Database\Eloquent\Builder) {
            $results = $this->model->get($columns);
        } else {
            $results = $this->model->all($columns);
        }

        $this->resetModel();

        return $this->parserResult($results);
    }

    public function get($columns = ['*'])
    {
        return $this->all($columns);
    }

    public function first($columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();
        $results = $this->model->first($columns);
        $this->resetModel();
        return $this->parserResult($results);
    }

    public function firstOrNew(array $attributes = [])
    {
        $this->applyCriteria();
        $this->applyScope();
        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);
        $model = $this->model->firstOrNew($attributes);
        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();
        return $this->parserResult($model);
    }

    public function firstOrCreate(array $attributes = [])
    {
        $this->applyCriteria();
        $this->applyScope();
        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);
        $model = $this->model->firstOrCreate($attributes);
        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();
        return $this->parserResult($model);
    }

    public function paginate($limit = null, $columns = array('*'))
    {
        $this->applyCriteria();
        $this->applyScope();
        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
        $results = $this->model->paginate($limit, $columns);
        $this->resetModel();
        return $this->parserResult($results);
    }

    public function simplePaginate($limit = null, $columns = ['*'])
    {
        return $this->paginate($limit, $columns, "simplePaginate");
    }

    public function find($id, $columns = array('*'))
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->findOrFail($id, $columns);
        $this->resetModel();
        return $this->parserResult($model);
    }

    public function findByField($field, $value = null, $columns = array('*'))
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->where($field, '=', $value)->get($columns);
        $this->resetModel();
        return $this->parserResult($model);
    }

    public function findWhere(array $where, $columns = array('*'))
    {
        $this->applyCriteria();
        $this->applyScope();

        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }

        $model = $this->model->get($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    public function findWhereIn($field, array $values, $columns = array('*'))
    {
        $this->applyCriteria();
        $model = $this->model->whereIn($field, $values)->get($columns);
        $this->resetModel();
        return $this->parserResult($model);
    }

    public function findWhereNotIn($field, array $values, $columns = array('*'))
    {
        $this->applyCriteria();
        $model = $this->model->whereNotIn($field, $values)->get($columns);
        $this->resetModel();
        return $this->parserResult($model);
    }

    public function create(array $attributes)
    {
        if (!is_null($this->validator)) {
            // we should pass data that has been casts by the model
            // to make sure data type are same because validator may need to use
            // this data to compare with data that fetch from database.
            if ($this->versionCompare($this->app->version(), "5.2.*", ">")) {
                $attributes = $this->model->newInstance()->forceFill($attributes)->makeVisible($this->model->getHidden())->toArray();
            } else {
                $model = $this->model->newInstance()->forceFill($attributes);
                $model->addVisible($this->model->getHidden());
                $attributes = $model->toArray();
            }
            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }

        $model = $this->model->newInstance($attributes);
        $model->save();
        $this->resetModel();

        // event(new RepositoryEntityCreated($this, $model));

        return $this->parserResult($model);
    }

    public function createAdvance(array $attributes)
    {
        $model = $this->model->create($attributes);
        $model->save();
        $this->resetModel();
        return $this->parserResult($model);
    }

    public function update(array $attributes, $id)
    {
        $this->applyScope();
        if (!is_null($this->validator)) {
            // we should pass data that has been casts by the model
            // to make sure data type are same because validator may need to use
            // this data to compare with data that fetch from database.
            if ($this->versionCompare($this->app->version(), "5.2.*", ">")) {
                $attributes = $this->model->newInstance()->forceFill($attributes)->makeVisible($this->model->getHidden())->toArray();
            } else {
                $model = $this->model->newInstance()->forceFill($attributes);
                $model->addVisible($this->model->getHidden());
                $attributes = $model->toArray();
            }
            $this->validator->with($attributes)->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);
        }

        $_skipPresenter = $this->skipPresenter;

        $this->skipPresenter(true);

        $model = $this->model->findOrFail($id);
        $model->fill($attributes);
        $model->save();

        $this->skipPresenter($_skipPresenter);
        $this->resetModel();

        // event(new RepositoryEntityUpdated($this, $model));

        return $this->parserResult($model);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        $this->applyScope();

        if (!is_null($this->validator)) {
            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_UPDATE);
        }

        $temporarySkipPresenter = $this->skipPresenter;

        $this->skipPresenter(true);

        $model = $this->model->updateOrCreate($attributes, $values);

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        // event(new RepositoryEntityUpdated($this, $model));

        return $this->parserResult($model);
    }

    public function delete($id)
    {
        $this->applyScope();

        $_skipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->find($id);
        $originalModel = clone $model;

        $this->skipPresenter($_skipPresenter);
        $this->resetModel();

        $deleted = $model->delete();

        // event(new RepositoryEntityDeleted($this, $originalModel));

        return $deleted;
    }

    public function deleteWhere(array $where)
    {
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $this->applyConditions($where);

        $deleted = $this->model->delete();

        // event(new RepositoryEntityDeleted($this, $this->model->getModel()));

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        return $deleted;
    }

    public function orderBy($column, $direction = 'asc')
    {
        $this->model = $this->model->orderBy($column, $direction);
        return $this;
    }

    public function with($relation)
    {
        $this->model = $this->model->with($relation);
        return $this;
    }

    public function withArray($relations)
    {
        foreach ($relations as $relation) {
            $this->model = $this->model->with($relation);
        }
        return $this;
    }

    public function withCount($relations)
    {
        $this->model = $this->model->withCount($relations);
        return $this;
    }

    public function has(string $relation)
    {
        $this->model = $this->model->has($relation);
        return $this;
    }

    public function whereHas(string $relation, \Closure $closure)
    {
        $this->model = $this->model->whereHas($relation, $closure);
        return $this;
    }

    public function hidden(array $fields)
    {
        $this->model->setHidden($fields);
        return $this;
    }

    public function visible(array $fields)
    {
        $this->model->setVisible($fields);
        return $this;
    }

    public function pushCriteria($criteria)
    {
        if (is_string($criteria)) {
            $criteria = new $criteria;
        }
        if (!$criteria instanceof CriteriaInterface) {
            throw new RepositoryException("Class " . get_class($criteria) . " must be an instance of Frameworks\\Cores\\Interface\\CriteriaInterface");
        }
        $this->criteria->push($criteria);
        return $this;
    }

    public function popCriteria($criteria)
    {
        $this->criteria = $this->criteria->reject(function ($item) use ($criteria) {
            if (is_object($item) && is_string($criteria)) {
                return get_class($item) === $criteria;
            }
            if (is_string($item) && is_object($criteria)) {
                return $item === get_class($criteria);
            }
            return get_class($item) === get_class($criteria);
        });
        return $this;
    }

    public function getCriteria()
    {
        return $this->criteria;
    }

    public function getByCriteria(CriteriaInterface $criteria)
    {
        $this->model = $criteria->apply($this->model, $this);
        $results = $this->model->get();
        $this->resetModel();
        return $this->parserResult($results);
    }

    public function skipCriteria($status = true)
    {
        $this->skipCriteria = $status;
        return $this;
    }

    public function resetCriteria()
    {
        $this->criteria = new Collection();
        return $this;
    }

    public function resetScope()
    {
        $this->scopeQuery = null;
        return $this;
    }

    protected function applyScope()
    {
        if (isset($this->scopeQuery) && is_callable($this->scopeQuery)) {
            $callback = $this->scopeQuery;
            $this->model = $callback($this->model);
        }
        return $this;
    }

    protected function applyCriteria()
    {
        if ($this->skipCriteria === true) {
            return $this;
        }
        $criteria = $this->getCriteria();
        if ($criteria) {
            foreach ($criteria as $c) {
                if ($c instanceof CriteriaInterface) {
                    $this->model = $c->apply($this->model, $this);
                }
            }
        }
        return $this;
    }

    protected function applyConditions(array $where)
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
    }

    public function skipPresenter($status = true)
    {
        $this->skipPresenter = $status;
        return $this;
    }

    public function parserResult($result)
    {
        if ($this->presenter instanceof PresenterInterface) {
            if ($result instanceof Collection || $result instanceof LengthAwarePaginator) {
                $result->each(function ($model) {
                    if ($model instanceof Presentable) {
                        $model->setPresenter($this->presenter);
                    }
                    return $model;
                });
            } elseif ($result instanceof Presentable) {
                $result = $result->setPresenter($this->presenter);
            }
            if (!$this->skipPresenter) {
                return $this->presenter->present($result);
            }
        }
        return $result;
    }
}
