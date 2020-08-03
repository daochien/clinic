<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
//            'device_name' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        \Auth::attempt($credentials);
        $token = \Auth::user()->createToken('token-name');
        
        return $token->plainTextToken;
    }
}
