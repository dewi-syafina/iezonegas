<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrangTua;

class ParentLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // ✅ Cek dulu apakah email terdaftar
        $parent = OrangTua::where('email', $request->email)->first();
        if (!$parent) {
            return back()
                ->withErrors(['email' => 'Email tidak ditemukan'])
                ->withInput($request->only('email'));
        }

        // ✅ Kalau email benar, cek password
        if (!Auth::guard('parent')->attempt($request->only('email', 'password'))) {
            return back()
                ->withErrors(['password' => 'Password salah'])
                ->withInput($request->only('email'));
        }

        // ✅ Login sukses
        $request->session()->regenerate();
        return redirect()->route('parent.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('parent')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('parent.login');
    }
}
