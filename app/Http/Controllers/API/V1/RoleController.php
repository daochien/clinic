<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Repositories\RoleRepository;
use App\Http\Requests\Roles\RoleRequest;

class RoleController extends BaseController
{

    protected $role = '';

    protected $roleRepo;

    public function __construct(
        Role $role,
        RoleRepository $roleRepo
    )
    {
        $this->role = $role;
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
        $roles = $this->roleRepo->get();

        return $this->sendResponse($roles, 'Role list');
    }

    public function list()
    {
        $roles = $this->role->pluck('name', 'id');

        return $this->sendResponse($roles, 'Role list');
    }

    public function store(RoleRequest $request)
    {        
        $role = $this->role->create([
            'name' => $request->name,
            'guard_name' => 'api'
        ]);

        $permissions = $request->permissions ? $request->permissions : [];
        
        $role->givePermissionTo($permissions);

        return $this->sendResponse($role, 'Role Created Successfully');
    }

    public function update(RoleRequest $request, $id)
    {        
        $role = $this->role->findOrFail($id);        
        $role->update($request->only('id', 'name'));

        $permissions = $request->permissions ? $request->permissions : [];
        $role->syncPermissions($permissions);

        return $this->sendResponse($role, 'Role Created Successfully');
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $role = $this->role->findOrFail($id);

        $role->delete();

        return $this->sendResponse($role, 'Role has been Deleted');
    }
}
