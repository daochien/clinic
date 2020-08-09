<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Permissions\PermissionRequest;

class PermissionController extends BaseController
{

    protected $permission;

    public function __construct(Permission $permission)
    {
        return $this->permission = $permission;
    }

    public function index()
    {
        $permissions = $this->permission->latest()->paginate(10);

        return $this->sendResponse($permissions, 'Permissions list');
    }

    public function store(PermissionRequest $request)
    {

        $permission = $this->permission->create([
            'name' => $request->name,
            'guard_name' => 'api'
        ]);

        return $this->sendResponse($permission, 'Permission Created Successfully');
    }

    public function update(PermissionRequest $request, $id)
    {
        $permission = $this->permission->findOrFail($id);
        
        $permission->update($request->all());
        
        return $this->sendResponse($permission, 'Permission Information has been updated');
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $permission = $this->permission->findOrFail($id);

        $permission->delete();

        return $this->sendResponse($permission, 'Permission has been Deleted');
    }

    public function list()
    {
        $permissions = $this->permission->all()->pluck('name', 'id');

        return $this->sendResponse($permissions, 'Permissions list');
    }

}
