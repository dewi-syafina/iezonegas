<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParentRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register-parent'); // buat view register orang tua
    }

   public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:orang_tuas,email',
        'password' => 'required|string|min:6|confirmed',
        'nis_siswa' => 'required|exists:siswas,nis', // validasi NIS
    ]);

    // Ambil siswa dari NIS
    $siswa = Siswa::where('nis', $request->nis_siswa)->first();

    if (!$siswa) {
        return back()->withInput()->withErrors(['nis_siswa' => 'NIS siswa tidak ditemukan.']);
    }

    // Simpan data orang tua
    $orangTua = OrangTua::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'siswa_id' => $siswa->id, // optional, tergantung relasi
    ]);

    // 🔹 Update siswa agar kolom parent_id / orang_tua_id terisi
    $siswa->update([
        'orang_tua_id' => $orangTua->id, // sesuaikan nama kolom di tabel siswas
    ]);

    return redirect()->route('login')->with('success', 'Registrasi orang tua berhasil. Silakan login.');
}

}
