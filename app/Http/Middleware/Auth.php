<?php

namespace App\Http\Middleware;

class Auth
{

    public function handle($request, \Closure $next, $guard = null)
    {
        if (!hasAdmin()) {
            return redirect('/content-adm');
        }

        return $next($request);
    }
}
