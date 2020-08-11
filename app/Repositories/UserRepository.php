<?php

namespace App\Repositories;

use App\Models\Clinic;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function listAdmin($roles, $params = [], $limit = 10)
    {
        if (!empty($params['role'])) {
            $roles = is_array($params['role']) ? $params['role'] : [$params['role']];
        }

        $query = $this->model->role($roles);


        if (!empty($params['keyword'])) {
            $query->where('name', 'like', '%'.$params['keyword'].'%');
        }

        return $query->with('roles')->latest()->paginate($limit);
    }

    public function get()
    {
        return $this->model->latest()->paginate(10);
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function createUser(array $attributes)
    {
        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
            'type' => $attributes['type'],
        ]);

        return $user;
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
            $result->delete();

            return true;
        }

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
        return $this->model->with('roles')->findOrFail($id);
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
