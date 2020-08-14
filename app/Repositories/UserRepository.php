<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
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

    public function search($keyword = '')
    {
        if (!empty($keyword)) {
            return $this->model->where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->with(['role', 'group','clinic'])
                ->paginate(10);
        }

        return $this->model->with(['role', 'group','clinic'])->paginate(10);
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
}
