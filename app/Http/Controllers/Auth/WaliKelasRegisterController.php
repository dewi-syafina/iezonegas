<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class WaliKelasRegisterController extends Controller
{
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

        // ✅ Simpan ke tabel users (akun utama)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
            'role' => 'wali_kelas',
        ]);

        // ✅ Simpan ke tabel wali_kelas (profil tambahan)
        WaliKelas::create([
            'user_id' => $user->id,
            'nama' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
        ]);

        // ✅ Login otomatis setelah registrasi
        Auth::login($user);

        return redirect()->route('walikelas.dashboard')->with('success', 'Registrasi wali kelas berhasil!');
    }
}
