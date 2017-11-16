<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class LoginAdminMiddleware
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
        if (\Auth::guest()) {
            return redirect('adm/login');
        }

        if (Auth::user()->nivel != 'administrador') {
            return redirect('/');
        }

        return $next($request);
    }
}
