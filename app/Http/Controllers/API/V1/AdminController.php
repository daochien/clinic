<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admins\AdminRequest;
use App\Models\Permission;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Services\AdminServices;

class AdminController extends BaseController
{
    protected $user;
    protected $userRepo;
    protected $roleRepo;
    protected $service = '';

    public function __construct(User $user, UserRepository $userRepo, RoleRepository $roleRepo, AdminServices $service)
    {
        $this->user = $user;
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $roles = $this->roleRepo->pluckName();
        $admins = $this->userRepo->listAdmin($roles, $request->only('role', 'keyword'));
        
        return $this->sendResponse($admins, 'Admin list');
    }

    public function store(AdminRequest $request)
    {
        try {
            $attributes = $request->all();
            $admin = $this->service->createAdmin($attributes);
            return $this->sendResponse($admin, 'Admin Created Successfully');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function show($id)
    {
        
        $admin = $this->userRepo->showAdmin($id);
        
        return $this->sendResponse($admin, 'Admin Details');
    }

    public function update(AdminRequest $request, $id)
    {
        $admin = $this->service->updateAdmin($id, $request->all());
       
        return $this->sendResponse($admin, 'Admin Information has been updated');
    }

    public function destroy($id)
    {

        //$this->authorize('isAdmin');

        $admin = $this->user->findOrFail($id);

        $admin->delete();

        return $this->sendResponse($admin, 'Admin has been Deleted');
    }
}
