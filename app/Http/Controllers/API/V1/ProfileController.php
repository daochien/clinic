<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ChangeMyPasswordRequest;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Return the user data
     *
     * @return Response
     */
    public function profile()
    {
        return $this->sendSuccessResponse(new UserResource(auth()->user()->load('role')));
    }


    /**
     * Update the profile by users
     *
     * @param  \App\Http\Requests\Users\ProfileUpdateRequest  $request
     *
     */
    public function updateProfile(ProfileUpdateRequest $request)
    {
        $roles = $request->get('roles');
        foreach ($roles as $role) {
            $roleName[] = $role['name'];
        }
        try {
            DB::beginTransaction();

            $user = auth()->user();
            $user->update($request->all());
            $user->syncRoles($roleName);
            DB::commit();

            return $this->sendSuccessResponse(new UserResource($user));
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->sendErrorResponse($exception->getMessage(), $exception->getCode());
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Users\ChangePasswordRequest  $request
     *
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();
        User::find($user->id)->update(['password' => Hash::make($request->new_password)]);
        //remove old token
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        //create new token
        $credentials = ['email' => $user->email, 'password' => $request->new_password];
        Auth::guard('web')->attempt($credentials);
        $token = Auth::guard('web')->user()->createToken($request->device_name);

        return $this->sendSuccessResponse(['token' => $token->plainTextToken]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Users\ChangePasswordRequest  $request
     *
     */
    public function changeMyPassword(ChangeMyPasswordRequest $request)
    {
        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return $this->sendSuccessResponse();
    }
}
