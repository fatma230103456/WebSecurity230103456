<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckUserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip middleware for login and register routes
        if ($request->is('login*') || $request->is('register*')) {
            return $next($request);
        }

        // Get the authenticated user
        $user = auth()->user();

        // If no user is authenticated, redirect to login
        if (!$user) {
            return redirect()->route('login');
        }

        // Get the target user from route parameters if it exists
        $targetUser = $request->route('user');
        
        // If we're dealing with a user-specific route
        if ($targetUser instanceof User) {
            // Admin with edit_users permission can access everything
            if ($user->canEditUsers()) {
                return $next($request);
            }

            // For profile routes, allow access if it's the user's own profile
            if ($request->is('users/*/profile*') || $request->is('profile*')) {
                if ($user->id === $targetUser->id) {
                    return $next($request);
                }
            }

            // For other user-specific routes, check permissions
            if ($user->id !== $targetUser->id) {
                abort(403, 'Unauthorized action.');
            }
        }

        // For role management routes, check manage_roles permission
        if ($request->is('roles*')) {
            if (!$user->hasPermission('manage_roles')) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        }

        // For user management routes (except profile), check edit_users permission
        if ($request->is('users*') && !$request->is('users/*/profile*') && !$request->is('profile*')) {
            if (!$user->hasPermission('edit_users')) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        }

        // For task management routes, check appropriate task permissions
        if ($request->is('tasks*')) {
            if ($request->isMethod('GET') && !$user->hasPermission('view_tasks')) {
                abort(403, 'Unauthorized action.');
            }
            if ($request->isMethod('POST') && !$user->hasPermission('create_tasks')) {
                abort(403, 'Unauthorized action.');
            }
            if ($request->isMethod(['PUT', 'PATCH']) && !$user->hasPermission('edit_tasks')) {
                abort(403, 'Unauthorized action.');
            }
            if ($request->isMethod('DELETE') && !$user->hasPermission('delete_tasks')) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        }

        // Allow access to profile and other public routes
        if ($request->is('profile*') || $request->is('/')) {
            return $next($request);
        }

        // For any other routes, check if user has any permission
        if (!$user->role || $user->role->permissions->isEmpty()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
} 