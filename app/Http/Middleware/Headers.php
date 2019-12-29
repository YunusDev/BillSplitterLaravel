<?php

namespace App\Http\Middleware;

use Closure;

class Headers
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
        $response = $next($request);

        $response->header('Content-Type', 'application/json')
                        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                        ->header('Access-Control-Allow-Origin', '*')
                        ->header('X-Requested-With', 'XMLHttpRequest');

        return $response;

    }
}
