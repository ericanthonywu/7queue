<?php

namespace App\Http\Middleware;

use Closure;

class globaladmincheck
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
        return \Session::get('name') && \Session::get('id') ? $next($request) : redirect('/');
    }
}
