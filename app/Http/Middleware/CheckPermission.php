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
        $user = Auth::user();

        if ($user->isRoot()) {
            return $next($request);
        }

        $routeName = $request->route()->getName();

        $permissions = Permission::where('name', $routeName)->pluck('name')->toArray();

        if ($user->hasAnyPermission($permissions)) {
            return $next($request);
        }

        return response()->json([
            'status' => false,
            'message' => 'Permission denied!'
        ], 403);
    }
}
