<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Gunakan guard siswa
        if (Auth::guard('siswa')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Redirect ke dashboard siswa
            return redirect()->route('siswa.dashboard');
        }

        return back()->withErrors(['error' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();

        // Pastikan session bersih
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('status', 'Anda berhasil logout.');
    }
}
