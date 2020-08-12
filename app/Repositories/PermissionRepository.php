<?php

namespace App\Repositories;

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
                    'guard_name' => 'api'
                ];
            }
        }

        $this->model->insert($insertPermissions);

    }
}
