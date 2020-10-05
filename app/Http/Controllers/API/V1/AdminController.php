<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use Illuminate\Http\Request;
use App\Http\Requests\Admins\AdminRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
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
    protected $role;
    protected $service = '';

    public function __construct(User $user, UserRepository $userRepo, RoleRepository $roleRepo, AdminServices $service, Role $role)
    {
        $this->user = $user;
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
        $this->service = $service;
        $this->role = $role;
    }

    public function index(Request $request)
    {
        $roles = $this->roleRepo->pluckName();
        $admins = $this->userRepo->listAdmin($roles, $request->only('role', 'keyword'));

        return new AdminCollection($admins);
    }

    public function store(AdminRequest $request)
    {
        try {
            $attributes = $request->all();
            $admin = $this->service->createAdmin($attributes);
            return $this->sendSuccessResponse($admin, 'Admin Created Successfully');
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        $admin = $this->userRepo->showAdmin($id);

        return $this->sendSuccessResponse($admin, 'Admin Details');
    }

    /**
     * Return the user data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $profile = $this->userRepo->showAdmin(auth()->user()->id);

        return $this->sendSuccessResponse(new AdminResource($profile));
    }

    public function update(AdminRequest $request, $id)
    {
        $admin = $this->service->updateAdmin($id, $request->all());

        return $this->sendSuccessResponse($admin, 'Admin Information has been updated');
    }

    public function destroy($id)
    {
        $roleRoot = $this->roleRepo->show(1);

        $admin = $this->user->findOrFail($id);

        if ($admin->hasRole($roleRoot->name)) {
            return $this->sendErrorResponse('Cannot remove super_user');
        }

        $admin->delete();

        return $this->sendSuccessResponse($admin, 'Admin has been Deleted');
    }

    public function roles(Request $request)
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
}
