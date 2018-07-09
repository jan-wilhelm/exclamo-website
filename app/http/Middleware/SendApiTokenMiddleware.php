<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class SendApiTokenMiddleware
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
        if (Auth::check()) {
            $token = Auth::user()->api_token;
            $cookie = Cookie::make(
                'api_token',        // name
                $token,             // value
                120,      // expire
                "/",                // path
                "",                 // domain
                false,              // secure
                true                // http-only
            );
            Cookie::queue($cookie);
        }

        return $next($request);
    }
}
