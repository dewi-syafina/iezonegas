<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Izin;
use Illuminate\Support\Facades\Auth;

class SiswaDashboardController extends Controller
{
    public function dashboard()
    {
        // Ambil data siswa yang login beserta relasi kelas, wali kelas, dan orang tua
        $siswa = Auth::guard('siswa')->user()->load(['kelas.waliKelas', 'orangTua']);

        // Ambil riwayat izin siswa beserta relasi orang tua dan wali kelas
        $izinList = Izin::with(['orangTua', 'siswa.kelas.waliKelas'])
                        ->where('siswa_id', $siswa->id)
                        ->latest()
                        ->get();

        return view('siswa.dashboard', compact('siswa', 'izinList'));
    }
}
