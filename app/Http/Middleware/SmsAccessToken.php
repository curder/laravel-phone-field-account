<?php

namespace App\Http\Middleware;

use Closure;

class SmsAccessToken
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
        if($request->has('phone')) {
            $request->headers->set('access-token', $request->input('phone'));
        }

        return $next($request);
    }
}
