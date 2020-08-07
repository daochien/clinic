<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admins\AdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends BaseController
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
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

        $admin->roles()->sync($roleIds);

        return $this->sendResponse($admin, 'Admin Created Successfully');
    }
}
