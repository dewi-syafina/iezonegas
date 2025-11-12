<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Gunakan guard parent
        if (Auth::guard('parent')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Redirect ke dashboard parent
            return redirect()->route('parent.dashboard');
        }

        return back()->withErrors(['error' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('parent')->logout();

        // Pastikan session bersih
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('status', 'Anda berhasil logout.');
    }
}
