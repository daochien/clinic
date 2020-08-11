<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admins\AdminRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends BaseController
{
    protected $user;
    protected $userRepo;
    protected $roleRepo;

    public function __construct(User $user, UserRepository $userRepo, RoleRepository $roleRepo)
    {
        $this->user = $user;
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }

    public function index(Request $request)
    {
        $roles = $this->roleRepo->pluckName();        
        $admins = $this->userRepo->listAdmin($roles, $request->only('role', 'keyword'));

        return $this->sendResponse($admins, 'Admin list');      
    }

    public function store(AdminRequest $request)
    {   
        DB::beginTransaction();
        try {
            $admin = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'type' => 'admin',
                'password' => Hash::make('123123'),
            ]);
            
            $roles = $request->roles ? $request->roles : [];
            $admin->assignRole($roles);
            DB::commit();
            return $this->sendResponse($admin, 'Admin Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();            
        }
        
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

        $roles = $request->roles ? $request->roles : [];
        $admin->syncRoles($roles);

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
