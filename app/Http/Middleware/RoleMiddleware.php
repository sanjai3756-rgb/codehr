<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $userRole = strtolower(trim(auth()->user()->role));

        $roles = collect($roles)
            ->flatMap(function ($r) {
                return explode(',', $r);
            })
            ->map(function ($r) {
                return strtolower(trim($r));
            })
            ->toArray();

        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}