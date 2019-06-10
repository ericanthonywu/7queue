<?php

namespace App\Http\Middleware;

use Closure;

class superadmincheck
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
        return \Session::get('level') == 3 ? $next($request) : redirect('/');
    }
}
