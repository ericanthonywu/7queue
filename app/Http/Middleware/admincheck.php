<?php

namespace App\Http\Middleware;

use Closure;

class admincheck
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
        return \Session::get('level') == 2 ? $next($request) : response()->view('error.404', [], 404);;
    }
}
