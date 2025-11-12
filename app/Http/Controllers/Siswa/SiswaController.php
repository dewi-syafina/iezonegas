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
        $siswa = Auth::guard('siswa')->user();

        $izinList = Izin::where('siswa_id', $siswa->id)
            ->with(['orangTua', 'siswa.waliKelas'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.dashboard', compact('siswa', 'izinList'));
    }

    // Halaman riwayat izin
    public function izin()
    {
        $siswa = Auth::guard('siswa')->user();

        $izinList = Izin::where('siswa_id', $siswa->id)
            ->with(['orangTua'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.izin', compact('siswa', 'izinList'));
    }

    // Profil siswa
    public function profil()
    {
        $siswa = Auth::guard('siswa')->user();

        return view('siswa.profil', compact('siswa'));
    }
}
