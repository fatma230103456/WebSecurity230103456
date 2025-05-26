<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        if (!$request->user() || !$request->user()->hasPermission($permissions)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
} 