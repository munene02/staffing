<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RequisitionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && (Auth::user()->role == 1 || Auth::user()->role == 3 || Auth::user()->role == 4 || Auth::user()->role >=8)) {
            
            return $next($request);
        }else{
            return redirect('/accessdenied');
        }
    }
}