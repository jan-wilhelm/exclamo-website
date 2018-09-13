<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class SendApiTokenMiddleware
{
    /**
     * Send the api_token cookie to all the incoming HTTP requests so that
     * it can be used in AJAX API requests
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $token = \JWTAuth::fromUser(Auth::user());
            $cookie = Cookie::make(
                'token',            // name
                $token,    // value
                0,                  // expire
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
