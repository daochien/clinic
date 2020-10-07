<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\V1\BaseController;
use App\Models\LoginLog;
use App\Services\SNSService;
use App\Services\UserDeviceTokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LoginController extends BaseController
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
            'device_token' => 'required',
            'platform' => ['required', Rule::in(['ios', 'android'])],
        ]);

        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return $this->unauthorizedResponse();
        }
        $authUser = Auth::user();

        if ($authUser->isMobileUser() || $authUser->isAdminOrRoot()) {
//            $userDeviceTokenService = app(UserDeviceTokenService::class);
//            $userDeviceTokenService->saveArnToThisDevice($authUser, $request->only('device_token', 'platform'));
            $token = $authUser->createToken($request->device_name);
            LoginLog::create(['user_id' => $authUser->id]);

            return $this->sendSuccessResponse(['token' => $token->plainTextToken]);
        }

        Auth::guard('web')->logout();
        return $this->sendErrorResponse("Invalid", "Permission denied", 403);
    }
}
