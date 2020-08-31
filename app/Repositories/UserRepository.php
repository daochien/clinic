<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        parent::__construct();
        $this->roleRepository = $roleRepository;
    }

    public function getModel()
    {
        return User::class;
    }

    public function listAdmin($roles, $params = [], $limit = 10)
    {
        if (!empty($params['role'])) {
            $roles = is_array($params['role']) ? $params['role'] : [$params['role']];
        }

        $query = $this->model->whereHas("roles", function ($q) use ($roles) {
            $q->whereIn('name', $roles)->whereIn('id', User::ADMIN_ID);
        });

        if (!empty($params['keyword'])) {
            $query->where('name', 'like', '%' . $params['keyword'] . '%');
        }

        return $query->with('roles')->latest()->paginate($limit);

        // if (!empty($params['role'])) {
        //     $roles = is_array($params['role']) ? $params['role'] : [$params['role']];
        // }

        // $query = $this->model->role($roles);

        // if (!empty($params['keyword'])) {
        //     $query->where('name', 'like', '%' . $params['keyword'] . '%');
        // }

        return $query->with('roles')->latest()->paginate($limit);

    }

    public function listUser()
    {
        return User::from('users as u')
            ->join('model_has_roles as mhr', 'mhr.model_id', 'u.id')
            ->whereIn('mhr.role_id', array_values(User::USER_ROLE))
            ->with(['role', 'group', 'clinic', 'type'])->paginate(10);
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
        $query = User::from('users as u')
            ->join('model_has_roles as mhr', 'mhr.model_id', 'u.id')
            ->whereIn('mhr.role_id', array_values(User::USER_ROLE));

        if (isset($param['keyword'])) {
            $query->where('name', 'LIKE', "%{$param['keyword']}%")
                ->orWhere('email', 'LIKE', "%{$param['keyword']}%");
        }

        if (isset($param['clinic_id'])) {
            $query->join('clinic_users as cu', function ($join) use ($param) {
                $join->on('cu.user_id', 'u.id')->where('cu.clinic_id', $param['clinic_id']);
            });
        }
//
//        if (isset($param['group_id'])) {
//            $query->join('group_users as gu', function ($join) use ($param) {
//                $join->on('gu.user_id', 'u.id')->where('gu.group_id', $param['group_id']);
//            });
//        }
        if (isset($param['type_id'])) {
            $query->join('type_users as tp', function ($join) use ($param) {
                $join->on('tp.user_id', 'u.id')->where('tp.type_id', $param['type_id']);
            });
        }

        return $query->with(['role', 'type','clinic'])->select('u.*')->paginate(10);
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
            'password' => Hash::make($attributes['password']),
            'description' => $attributes['description'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function show($id)
    {
        return $this->model->with('roles')->findOrFail($id);
    }

    public function showAdmin($id)
    {
        return $this->model->with('roles', 'type')->findOrFail($id);
    }

    public function createAdmin(array $attributes)
    {
        return User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'description' => $attributes['description'],
            'password' => Hash::make($attributes['password']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
