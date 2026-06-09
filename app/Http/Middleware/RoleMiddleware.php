<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class RoleMiddleware
{
    /**
     * @param string[] $roles
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        if (! in_array($request->user()->role, $roles, true)) {
            abort(403);
        }
        return $next($request);
    }
}
