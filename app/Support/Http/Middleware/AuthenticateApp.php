<?php

namespace Support\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateApp
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken() !== config('stop-covid.token')) {
            abort(401);
        }

        return $next($request);
    }
}
