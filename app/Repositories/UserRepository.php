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
            $query->where('name', 'like', '%' . $params['keyword'] . '%');
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
        return User::with(['role', 'group', 'type', 'clinic', 'level'])->find($id);
    }

    public function search($param = [])
    {
        $query = User::from('users as u')->with(['role', 'group','clinic'])->select('u.*');

        if (!empty($keyword = $param['keyword'])) {
            $query->where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%");
        }

        if (!empty($clinicId = $param['clinic_id'])) {
            $query->join('clinic_users as cu', function ($join) use ($clinicId) {
               $join->on('cu.user_id', 'u.id')->where('cu.clinic_id', $clinicId);
            });
        }

        if (!empty($groupId = $param['group_id'])) {
            $query->join('group_users as gu', function ($join) use ($groupId) {
               $join->on('gu.user_id', 'u.id')->where('gu.group_id', $groupId);
            });
        }

        return $query->paginate(10);
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function createUser(array $attributes)
    {
        return User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make(User::DEFAULT_PASSWORD),
            'description' => $attributes['description'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function show($id)
    {
        return $this->model->with('roles')->findOrFail($id);
    }
}
