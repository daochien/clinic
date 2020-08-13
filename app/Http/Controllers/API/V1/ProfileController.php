<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return $this->sendResponse(auth()->user());
    }


    /**
     * Update the profile by users
     *
     * @param  \App\Http\Requests\Users\ProfileUpdateRequest  $request
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateProfile(ProfileUpdateRequest $request)
    {
        $user = auth()->user();
        $user->update($request->all());

        return $this->sendResponse($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Users\ChangePasswordRequest  $request
     *
     * @return \Illuminate\Http\Response
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

        return $this->sendResponse(['token' => $token->plainTextToken]);
    }
}
