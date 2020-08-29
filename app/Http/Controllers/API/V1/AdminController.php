<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admins\AdminRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Services\AdminServices;
use App\Http\Resources\AdminCollection;
use Illuminate\Support\Facades\Auth;

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
        // $user = Auth::user();
        // dd($user->getPermissionNames());
        $roles = $this->roleRepo->pluckName();
        $admins = $this->userRepo->listAdmin($roles, $request->only('role', 'keyword'));

        return new AdminCollection($admins);
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

        $roleRoot = $this->roleRepo->show(1);

        $admin = $this->user->findOrFail($id);

        if ($admin->hasRole($roleRoot->name)) {
            return $this->sendError('Cannot remove super_user');
        }

        $admin->delete();

        return $this->sendResponse($admin, 'Admin has been Deleted');
    }
}
