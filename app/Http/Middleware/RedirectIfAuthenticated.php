<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle($request, \Closure $next, ...$guards)
{
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            switch ($guard) {
                case 'siswa':
                    return redirect()->route('siswa.dashboard');
                case 'parent':
                    return redirect()->route('parent.dashboard');
                case 'wali':
                    return redirect()->route('wali.dashboard');
                default:
                    return redirect('/dashboard');
            }
        }
    }

    return $next($request);
}


}
