<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Orangtua;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|in:siswa,orangtua,guru',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|unique:siswas|unique:orangtuas|unique:gurus',
            'password' => 'required|min:6|confirmed',
            'nis' => 'nullable|string|max:20',
        ]);

        // === Simpan berdasarkan role ===
        if ($validated['role'] === 'siswa') {
            Siswa::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'nis' => $validated['nis'],
                'password' => Hash::make($validated['password']),
            ]);
        } elseif ($validated['role'] === 'orangtua') {
            Orangtua::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
        } elseif ($validated['role'] === 'guru') {
            Guru::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
        }

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login!');
    }
}
