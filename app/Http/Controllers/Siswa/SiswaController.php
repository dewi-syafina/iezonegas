<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Izin;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }

    // Dashboard utama siswa
    public function dashboard()
    {
        $siswa = Auth::user()->siswa; // ambil data siswa terkait user

        // Ambil seluruh izin yang diajukan oleh orang tua untuk siswa ini
        $izinList = Izin::where('siswa_id', $siswa->id)
            ->with('waliKelas') // relasi ke wali kelas jika ada
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.dashboard', compact('siswa', 'izinList'));
    }

    // Halaman riwayat izin (opsional, bisa dipisah)
    public function izin()
    {
        $siswa = Auth::user()->siswa;

        $izinList = Izin::where('siswa_id', $siswa->id)
        ->with('waliKelas')
        ->orderBy('created_at', 'desc')
        ->get();


        return view('siswa.izin', compact('siswa', 'izinList'));
    }

    // Profil siswa (opsional jika ada halaman khusus)
    public function profil()
    {
        $siswa = Auth::user()->siswa;
        return view('siswa.profil', compact('siswa'));
    }
}
