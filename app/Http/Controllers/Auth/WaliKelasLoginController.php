<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaliKelasLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
        'email' => 'required|email|exists:wali_kelas,email',
        'password' => 'required',
    ]);

        if (Auth::guard('walikelas')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('walikelas.dashboard');

        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout(Request $request)
    {
        Auth::guard('walikelas')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('walikelas.login');
    }
}
