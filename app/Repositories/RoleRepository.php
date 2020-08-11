<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;

class RoleRepository
{

    protected $model;

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function pluckName()
    {
        return $this->model->pluck('name')->toArray();
    }

    public function get()
    {
        return $this->model->with(['permissions' => function ($q) {
            $q->select('name', 'id');
        }])->latest()->paginate(10);
    }
            
}
