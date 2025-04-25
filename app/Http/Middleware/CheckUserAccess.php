<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserAccess
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Admin with edit_users permission can do everything
        if ($user->hasPermission('edit_users')) {
            return $next($request);
        }

        // Normal users can only view and edit their own profile
        if ($permission === 'view_profile' || $permission === 'edit_profile') {
            $requestedUser = $request->route('user');
            $requestedUserId = is_object($requestedUser) ? $requestedUser->id : $requestedUser;
            
            if ($user->id == $requestedUserId) {
                return $next($request);
            }
        }

        // Employees can edit general user information
        if ($user->hasRole('Employee') && $permission === 'edit_general_info') {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'Access Denied');
    }
} 