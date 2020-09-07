<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\V1\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LogoutController extends BaseController
{
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $user = auth()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        Auth::guard('web')->logout();

        return $this->sendSuccessResponse();
    }
}
