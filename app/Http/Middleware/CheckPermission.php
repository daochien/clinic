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
        $user = Auth::user();
        if ($user->isAdmin()) {
            return $next($request);    
        }
        
        $routeName = $request->route()->getName();
        
        $permission = Permission::where('route_name', $routeName)->first();
        
        if (!$permission) {
            return response()->json([
                'status' => false,
                'message' => 'Permission not access'
            ], 403);
        }

        if ($user->can($permission->name)) {
            return $next($request);
        }

        return response()->json([
            'status' => false,
            'message' => 'Permission not access'
        ], 403);
    }
}
