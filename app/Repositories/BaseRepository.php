<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    public function get()
    {
        return $this->model->latest()->paginate(config('app.item_per_request'));
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        return $this->model->updateOrCreate([
            'id' => $id,
        ], $attributes);
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            try {
                DB::beginTransaction();
                $result->delete();
                DB::commit();
            } catch(\Exception $exception) {
                DB::rollBack();
                return false;
            }
        }

        return true;
    }

    /**
     * Pagination
     * @param $perPage
     * @return mixed
     */
    public function paginate($perPage)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Latest
     * @return mixed
     */
    public function latest()
    {
        return $this->model->latest();
    }

    /**
     * show the record with the given id
     *
     * @param int $id
     *
     * @return mixed
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Set the associated model
     *
     * @param $model
     *
     * @return mixed
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Eager load database relationships
     *
     * @param String $relations
     *
     */
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    /**
     * On method call
     * To use Eloquent Methods which are not exist on repository
     *  Example Eloquent findOrFail() method
     *
     * @param $method
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            return Model::__call('setModel', [$this->model])->setTable($this->model->table)->$method(...$arguments);
        } else {
            return $this->model->$method(...$arguments);
        }
    }
}
