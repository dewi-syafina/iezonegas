<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterSiswaController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register-student');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:siswas,nis',
            'email' => 'required|string|email|max:255|unique:siswas,email',
            'password' => 'required|string|min:6|confirmed',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas_id' => 'nullable|exists:kelas,id', // opsional jika ingin pilih kelas
        ]);

        // ✅ Simpan ke tabel siswas
        $siswa = Siswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas_id' => 1,
            'orang_tua_id' => null, // bisa di-update saat register orang tua
        ]);

        // ✅ Redirect ke halaman login siswa dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi siswa berhasil. Silakan login.');
    }
}
