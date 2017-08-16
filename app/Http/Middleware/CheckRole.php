<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $guard = null)
    {
       
        if (Auth::guard($guard)->check() && Auth::user()->role == $role || Auth::user()->role >= $role) {
            
            return $next($request);
        }else{
            return redirect('/accessdenied');
        }
    }

}