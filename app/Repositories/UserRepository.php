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
}
