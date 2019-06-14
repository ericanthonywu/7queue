<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Session;

class superadmincheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return Session::get('level') == 3 ?
            $next($request) :
            (
            Request::url() == url('/admin') ?
                response()->view('admin',[],200) :
                response()->view('error.404', [], 404)
            );
    }
}
