<?php

namespace App\Repositories;

use App\Models\Role as ModelsRole;
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

    public function show($id)
    {
        return $this->model->with('permissions')->findOrFail($id);
    }

    public function getNamePermissions($pemissions, $roleId = '')
    {
        if (empty($pemissions)) {
            return [];
        }

        $pers = array();
        foreach ($pemissions as $permission) {
            if (!empty($permission['pers'])) {
                foreach ($permission['pers'] as $routes) {
                    $names = config('router.'.$routes);                    
                    if (!empty($names)) {
                        $pers = array_merge($pers, $names['routes']);
                    }
                }
            }
        }
        
        if (!empty($pers) && !in_array($roleId, [ModelsRole::ROLE_DEFAULT['web'], ModelsRole::ROLE_DEFAULT['mobile']])) {
            $settingRole = config('router.setting.groups');
            $settingPers = array();
            foreach ($settingRole as $item) {
                if (!empty($item['routes'])) {
                    $settingPers = array_merge($settingPers, $item['routes']);
                }            
            }
            
            $pers = array_unique(array_merge($pers, $settingPers));
        }        
            
        return $pers;
    }
}
