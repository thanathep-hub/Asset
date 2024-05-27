<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;

class CheckLogin
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
        if (!Session::has('user') && !$request->is('login')) {
            Session::put('previous_url', url()->current());
            return redirect('/login');
        }

        return $next($request);
    }
}
