<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User as WaliKelas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterSiswaController extends Controller
{
    public function showRegisterForm()
    {
        $kelas = Kelas::all();
        $waliKelas = WaliKelas::where('role', 'wali_kelas')->get();

        return view('auth.register-siswa', compact('kelas', 'waliKelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis',
            'email' => 'required|string|email|max:255|unique:siswas,email',
            'password' => 'required|string|min:6|confirmed',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan' => 'required|string|max:255',
            'wali_kelas_id' => 'required|exists:users,id',
        ]);

        // Buat user utama
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nis' => $request->nis,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        // Buat data siswa
        $siswa = Siswa::create([
            'user_id' => $user->id,
            'nama' => $request->name,
            'nis' => $request->nis,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas_id' => $request->kelas_id,
            'jurusan' => $request->jurusan,
            'wali_kelas_id' => $request->wali_kelas_id,
        ]);

        Auth::guard('siswa')->login($siswa);

        return redirect()->route('siswa.dashboard')->with('success', 'Registrasi siswa berhasil!');
    }
}

//    public function showRegisterForm()
  //  {
    ///    $kelas = Kelas::all();
       // $waliKelas = User::where('role', 'wali_kelas')->get();
        //return view('auth.register-siswa', compact('kelas', 'waliKelas'));
    //}


//}
