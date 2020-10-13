<?php

namespace App\Repositories;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class PermissionRepository
{

    protected $model;

    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function sync($permissions)
    {
        $permissionsExists = $this->model->whereIn('name', $permissions)->pluck('name')->toArray();

        $insertPermissions = [];
        foreach ($permissions as $item) {
            if (!in_array($item, $permissionsExists)) {
                $insertPermissions[] = [
                    'name' => $item,
                    'guard_name' => 'web'
                ];
            }
        }

        $this->model->insert($insertPermissions);

    }

    public function getUserByPermission($permission)
    {
        return Permission::query()->from('permissions as p')
            ->join('role_has_permissions as rp', 'rp.permission_id', 'p.id')
            ->join('model_has_roles as mr', 'mr.role_id', 'rp.role_id')
            ->join('users as u', 'u.id', 'mr.model_id')
            ->join('roles as r', 'r.id', 'rp.role_id')
            ->where('p.name', 'like', "%{$permission}%")
            ->whereNotIn('r.id', User::USER_ROLE)
            //not get root admin
            ->where('mr.model_id', '>', 1)
            ->distinct()
            ->select('u.*')
            ->get();

    }
}
