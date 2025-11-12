<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Izin;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = Auth::guard('siswa')->user();

        // Load relasi yang diperlukan
       // $siswa = Siswa::with([
         //   'kelas.waliKelas', // kelas -> wali kelas
         //   'waliKelas',       // wali kelas langsung
         //   'orangTua',        // orang tua
         //   'izins.siswa.kelas.waliKelas' // izin -> siswa -> kelas -> wali
       // ])->where('id', $siswa->id)->first();

       $siswa = Siswa::with(['waliKelas', 'kelas', 'orangTua'])->find(Auth::guard('siswa')->id());


        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan');
        }

        // Ambil riwayat izin terbaru
         $izinList = Izin::where('siswa_id', $siswa->id)
            ->with(['siswa.waliKelas', 'siswa.orangTua'])
            ->orderBy('created_at', 'desc')
            ->get();

        dd($siswa->waliKelas);
        return view('siswa.dashboard', compact('siswa', 'izinList'));
    }
}
