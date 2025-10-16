<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Izin;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data siswa sesuai guard siswa
        $siswa = Auth::guard('siswa')->user()->siswa;

        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan');
        }

        // Ambil seluruh izin yang diajukan oleh orang tua untuk siswa ini
        $izinList = \App\Models\Izin::where('siswa_id', $siswa->id)->get()
            ->with('waliKelas') // pastikan relasi waliKelas ada
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.dashboard', compact('siswa', 'izinList'));
    }
}
