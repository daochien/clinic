<?php

namespace App\Http\Controllers\API\V1;

use Spatie\Permission\Models\Permission;

class PermissionController extends BaseController
{

    protected $permission;

    public function __construct(Permission $permission)
    {
        return $this->permission = $permission;
    }
        
    public function listRoutes()
    {
        $routes = config('router');

        return $this->sendResponse($routes, 'Route list');
    }
    
}
