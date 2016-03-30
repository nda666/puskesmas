<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch (Auth::guard($guard)->user()->jabatan) {
                case 'Administrasi':
                    return redirect('/administrasi');
                    break;
                case 'Dokter':
                    return redirect('/dokter');
                    break;
                case 'Konsultan':
                    return redirect('/konsultan');
                    break;
                case 'Apoteker':
                    return redirect('/apoteker');
                    break;
                default:
                    abort(404);
                    break;
            }

        }
        return $next($request);
    }
}
