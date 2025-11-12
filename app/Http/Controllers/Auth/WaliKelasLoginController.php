<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WaliKelas;
use Illuminate\Support\Facades\Hash; // Untuk cek password


class WaliKelasLoginController extends Controller
{

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string',
        'password' => 'required|string',
    ]);

    if (Auth::guard('walikelas')->attempt($request->only('email','password'))) {
        $request->session()->regenerate();
        return redirect()->route('walikelas.dashboard'); // redirect ke route dashboard
    }

    return back()->withErrors(['error' => 'Email atau password salah']);
}

public function logout(Request $request)
{
    Auth::guard('walikelas')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('welcome');
}


public function dashboard()
{
    if (!session()->has('wali_id')) {
        return redirect()->route('login'); // Pastikan ada route ini
    }
    return view('wali.dashboard');
}


}
