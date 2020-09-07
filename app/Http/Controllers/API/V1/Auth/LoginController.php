<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\V1\BaseController;
use App\Models\LoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return $this->unauthorizedResponse();
        }
        $authUser = Auth::user();
        $token = $authUser->createToken($request->device_name);
        LoginLog::create(['user_id' => $authUser->id]);

        return $this->sendSuccessResponse(['token' => $token->plainTextToken]);
    }
}
