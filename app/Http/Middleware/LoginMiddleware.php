<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class LoginMiddleware
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
        // Si no esta logueado
        // if (\Auth::guest()) {
        //     return redirect('adm/login');
        // }
        if (Auth::guard()->check()) {
            return redirect('adm/login');
        }

        return $next($request);
    }
}
