<?php

namespace App\Http\Middleware;

use Closure;

class SingatureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $headername = 'X-Name')
    {
        $response =  $next($request);

        $response->headers->set($headername, config('app.name'));

        return $response;
    }
}
