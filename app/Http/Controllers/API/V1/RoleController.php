<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Repositories\RoleRepository;

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

}
