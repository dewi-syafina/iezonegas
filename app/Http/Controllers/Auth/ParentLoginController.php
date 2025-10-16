<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:orangtuas,email',
            'password' => 'required',
        ]);

        // ✅ Gunakan guard 'orangtua'
        if (Auth::guard('orangtua')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('orangtua.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout(Request $request)
    {
        // ✅ Ganti 'parent' ke 'orangtua'
        Auth::guard('orangtua')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ✅ Ganti route redirect-nya juga
        return redirect()->route('orangtua.login');
    }
}
