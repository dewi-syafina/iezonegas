<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class WaliRegisterController extends Controller
{

    // Tambahkan method create() supaya Breeze tidak error
    public function create()
    {
        return $this->showRegisterForm();
    }

    public function showRegisterForm()
    {
        return view('auth.register-wali');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'nip' => 'required|string|unique:users,nip',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
            'role' => 'wali',
        ]);

        Auth::login($user);

        return redirect()->route('wali.dashboard')->with('success', 'Registrasi wali kelas berhasil!');
    }
}
