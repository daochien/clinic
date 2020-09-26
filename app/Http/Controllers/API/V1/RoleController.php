<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;
use App\Http\Requests\Roles\RoleRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class RoleController extends BaseController
{

    protected $role = '';

    protected $roleRepo;

    protected $permission;

    public function __construct(
        Role $role,
        RoleRepository $roleRepo,
        PermissionRepository $permission
    )
    {
        $this->role = $role;
        $this->roleRepo = $roleRepo;
        $this->permission = $permission;
    }

    public function index()
    {
        $roles = $this->roleRepo->get();

        return $this->sendSuccessResponse($roles, 'Role list');
    }

    public function list(Request $request)
    {
        $user = Auth::user();

        if ( in_array($user->email, User::ROOT_EMAIL_ADMIN) || $user->hasRole(1) || $user->hasRole(2)) {
            $roles = $this->role->whereNotIn('id', [User::ROLE_ROOT, User::ROLE_STAFF_WEB, User::ROLE_STAFF_MOBILE])->select('name', 'id')->get();
        } else {
            $roles = $this->role->whereNotIn('id', [User::ROLE_ROOT, User::ROLE_ADMIN, User::ROLE_STAFF_WEB, User::ROLE_STAFF_MOBILE])->select('name', 'id')->get();
        }

        if (!$request->get('re-format')) {
            $roles = $roles->pluck('name', 'id');
        }

        return $this->sendSuccessResponse($roles, 'Role list');
    }

    public function store(RoleRequest $request)
    {
        
        $role = $this->role->create([
            'name' => strtolower($request->name),
            'guard_name' => 'web'
        ]);

        $permissions = $this->roleRepo->getNamePermissions($request->permissions);
        
        if (!empty($permissions)) {
            //sync permissions to db
            $this->permission->sync($permissions);
            //asign permission to role
            $role->givePermissionTo($permissions);
        }
        
        return $this->sendSuccessResponse($role, 'Role Created Successfully');
    }

    public function show($id)
    {
        $role = $this->roleRepo->show($id);

        return $this->sendSuccessResponse($role, 'Role Details');
    }

    public function update(RoleRequest $request, $id)
    {
        $role = $this->role->findOrFail($id);
        $role->update([
            'id' => $request->id,
            'name' => strtolower($request->name)
        ]);

        $permissions = $this->roleRepo->getNamePermissions($request->permissions);

        if (!empty($permissions)) {
            //sync permissions to db
            $this->permission->sync($permissions);
            //asign permission to role
            $role->syncPermissions($permissions);
        }

        return $this->sendSuccessResponse($role, 'Role Updated Successfully');
    }

    public function destroy($id)
    {

        //$this->authorize('isAdmin');

        $role = $this->role->findOrFail($id);

        $role->delete();

        return $this->sendSuccessResponse($role, 'Role has been Deleted');
    }
}
