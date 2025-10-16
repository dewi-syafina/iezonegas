<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaLoginController extends Controller
{
    /**
     * Tampilkan halaman login siswa
     */
    public function showLoginForm()
    {
        return view('auth.siswa-login');
    }

    /**
     * Proses login siswa
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|exists:siswas,email',
            'password' => 'required|string',
        ]);

        // Login dengan guard 'siswa'
        if (Auth::guard('siswa')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('siswa.dashboard');
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Logout pengguna
     */
    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('siswa.login')->with('status', 'Anda telah logout.');
    }
}
