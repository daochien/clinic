<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
        $user = Auth::user();

        if (in_array($user->email, User::ROOT_EMAIL_ADMIN)) {
            return $next($request);
        }

        if ($user->hasRole('system_admin')) {
            return $next($request);
        }

        $permissions = Permission::where('name', $routeName)->pluck('name')->toArray();

        // if ($user->hasAnyPermission($permissions)) {
        //     return $next($request);
        // }

        // return response()->json([
        //     'status' => false,
        //     'message' => 'Permission not access'
        // ], 403);
    }
}
