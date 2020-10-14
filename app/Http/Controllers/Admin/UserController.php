<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function myAccount(Request $request)
    {
        return view('client.myAccount');
    }
}
