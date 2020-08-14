<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function getModel()
    {
        return User::class;
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
        return User::with('role')->find($id);
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
        ]);

        return $user;
    }

    public function show($id)
    {
        return $this->model->with('roles')->findOrFail($id);
    }
}
