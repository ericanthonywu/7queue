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
        if(\Request::url() == url('/admin')){
            return \Session::get('level') == 3 ? $next($request) : response()->view('admin',[],200);
        }else {
            return \Session::get('name') && \Session::get('level') ? $next($request) : response()->view('error.404', [], 404);
        }
    }
}
