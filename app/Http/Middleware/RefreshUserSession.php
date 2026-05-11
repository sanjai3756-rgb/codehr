<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RefreshUserSession
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            Auth::setUser(Auth::user()->fresh());
        }

        return $next($request);
    }
}