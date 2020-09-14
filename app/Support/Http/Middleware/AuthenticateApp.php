<?php

namespace Support\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class AuthenticateApp
{
    /**
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken() !== config('stop-covid.token')) {
            throw new AuthorizationException();
        }

        return $next($request);
    }
}
