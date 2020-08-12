<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Route;
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
            'guard_name' => 'api',
            'route_name' => $request->route_name
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

    public function listRoutes()
    {
        $routes = collect(Route::getRoutes())->map(function ($route) {
            if ($route->getPrefix() == 'api') {
                $name = $route->getName();
                $arrName = explode('.', $name);
                if (isset($arrName[1]) && !empty($arrName[1])) {
                    return $name;
                }
            }
        })->toArray();

        $routes = array_filter($routes);

        $routeGroup = [];
        foreach ($routes as $name) {
            $arrName = explode('.', $name);
            if (isset($arrName[1]) && !empty($arrName[1])) {
                $routeGroup[$arrName[0]][] = $arrName[1];
            }
        }
        //dd($routeGroup);
        return $this->sendResponse($routeGroup, 'Route list');
    }

    public function show($id)
    {
        return $id;
    }
}
