<?php

namespace App\Repositories;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClinicRepository
{

    protected $model;

    public function __construct(Clinic $clinic)
    {
        $this->model = $clinic;
    }

    public function get()
    {
        return $this->model->latest()->withCount('clinicUsers')->paginate(10);
    }

    public function getAll()
    {
        return $this->model->orderByDesc('id')->get();
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
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
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
                    $result->clinicUsers()->delete();
                    $result->delete();
                    DB::commit();
                } catch(\Exception $exception) {
                    DB::rollBack();
                }
            }

            return true;



        return false;
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
        return $this->model->with('clinicUsers')->findOrFail($id);
    }

    /**
     * Get the associated model
     *
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the associated model
     *
     * @param $model
     *
     * @return mixed
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
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
