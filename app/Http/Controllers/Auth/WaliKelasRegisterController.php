<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaliKelas;
use Illuminate\Support\Facades\Hash;

class WaliKelasRegisterController extends Controller
{
    // Tampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register-wali'); // resources/views/auth/register-wali.blade.php
    }

    // Proses penyimpanan
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip'  => 'required|string|max:50|unique:wali_kelas,nip',
            'email'=> 'required|email|max:255|unique:wali_kelas,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan ke tabel wali_kelas (sesuai migration)
        $wali = WaliKelas::create([
            'nama'     => $request->nama,
            'nip'      => $request->nip,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Pilihan: jangan auto-login kecuali kamu sudah menyiapkan guard untuk wali_kelas.
        // Kembalikan ke halaman login wali_kelas dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi wali kelas berhasil. Silakan login.');
    }
}
