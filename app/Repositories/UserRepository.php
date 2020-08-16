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
        return User::with(['role', 'group', 'type', 'clinic', 'level'])->find($id);
    }

    public function search($param = [])
    {
        $query = User::from('users as u')->with(['role', 'group','clinic'])->select('u.*');

        if (isset($param['keyword'])) {
            $query->where('name', 'LIKE', "%{$param['keyword']}%")
                ->orWhere('email', 'LIKE', "%{$param['keyword']}%");
        }

        if (isset($param['clinic_id'])) {
            $query->join('clinic_users as cu', function ($join) use ($param) {
               $join->on('cu.user_id', 'u.id')->where('cu.clinic_id', $param['clinic_id']);
            });
        }

        if (isset($param['group_id'])) {
            $query->join('group_users as gu', function ($join) use ($param) {
               $join->on('gu.user_id', 'u.id')->where('gu.group_id', $param['group_id']);
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
}
