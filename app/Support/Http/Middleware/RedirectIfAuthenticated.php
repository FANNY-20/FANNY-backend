<?php

namespace Support\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    /**
     * @return mixed
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function handle(Request $request, Closure $next, ?string $guard = null)
    {
        return $next($request);
    }
}
