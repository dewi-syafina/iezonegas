<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterSiswaController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register-student');
    }

        public function create()
    {
        return $this->showRegisterForm(); // supaya Breeze tidak error
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
            'nis' => $request->nis,
        ]);

        Siswa::create([
            'user_id' => $user->id,
            'nama' => $request->name,
            'nis' => $request->nis,
            //'email' => $request->email,
        ]);

        Auth::login($user);

        return redirect()->route('siswa.dashboard')->with('success', 'Registrasi siswa berhasil!');
    }
}
