<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
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
        if ($user->type == 'admin') {
            return $next($request);
        }


        $routeName = $request->route()->getName();

        $permissions = Permission::where('route_name', $routeName)->pluck('name')->toArray();

        if ($user->hasAnyPermission($permissions)) {
            return $next($request);
        }

        return response()->json([
            'status' => false,
            'message' => 'Permission not access'
        ], 403);
    }
}
