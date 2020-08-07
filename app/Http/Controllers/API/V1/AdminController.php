<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admins\AdminRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AdminController extends BaseController
{
    protected $user;
    protected $userRepo;

    public function __construct(User $user, UserRepository $userRepo)
    {
        $this->user = $user;
        $this->userRepo = $userRepo;
    }

    public function index(Request $request)
    {
        $admins = $this->userRepo->listAdmin($request->only('role_id', 'keyword'));

        return $this->sendResponse($admins, 'Admin list');      
    }

    public function store(AdminRequest $request)
    {
        $admin = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => 'admin',
            'password' => Hash::make('123123'),
        ]);

        $roleIds = array();
        foreach ($request->role_ids as $role) {
            $roleIds[] = $role;
        }

        $admin->getRoles()->sync($roleIds);

        return $this->sendResponse($admin, 'Admin Created Successfully');
    }

    public function show($id)
    {
        $admin = $this->userRepo->show($id);

        return $this->sendResponse($admin, 'Admin Details');
    }

    public function update(AdminRequest $request, $id)
    {
        $admin = $this->user->findOrFail($id);

        $admin->update($request->all());

        $roleIds = array();
        foreach ($request->role_ids as $role) {
            $roleIds[] = $role;
        }

        $admin->getRoles()->sync($roleIds);

        return $this->sendResponse($admin, 'Admin Information has been updated');
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $admin = $this->user->findOrFail($id);

        $admin->delete();

        return $this->sendResponse($admin, 'Admin has been Deleted');
    }
}
