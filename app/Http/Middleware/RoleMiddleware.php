<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek semua guard yang mungkin aktif (web, siswa)
        $user = Auth::guard('web')->user() ?? Auth::guard('siswa')->user();

        if (!$user) {
            // Belum login sama sekali
            return redirect()->route('login');
        }

        // Cek role sesuai kolom di database users
        if (!isset($user->role) || $user->role !== $role) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
