<?php

namespace App\Http\Middleware;

use Closure;

class AuthorizeUserToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard($guard)->check()) {
            // check if token is sended with query
            
        }

        return $next($request);
    }
}
