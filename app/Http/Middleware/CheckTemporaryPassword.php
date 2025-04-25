<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTemporaryPassword
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_temporary_password) {
            return redirect()->route('password.change')
                ->with('warning', 'Please change your temporary password.');
        }

        return $next($request);
    }
} 