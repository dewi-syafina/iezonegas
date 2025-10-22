<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class WaliKelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:walikelas');
    }

    // 🟦 Dashboard utama wali kelas
    public function dashboard()
    {
        $wali = Auth::guard('walikelas')->user();

        // Ambil semua siswa yang diawali wali_kelas_id = wali yang login
        $siswaIds = Siswa::where('wali_kelas_id', $wali->id)->pluck('id');

        // Ambil semua izin milik siswa yang diawalinya
        $izinPending = Izin::whereIn('siswa_id', $siswaIds)
            ->where('status', 'pending')
            ->with(['siswa', 'orangTua'])
            ->latest()
            ->get();

        $izinCount = [
            'pending'   => Izin::whereIn('siswa_id', $siswaIds)->where('status', 'pending')->count(),
            'disetujui' => Izin::whereIn('siswa_id', $siswaIds)->where('status', 'disetujui')->count(),
            'ditolak'   => Izin::whereIn('siswa_id', $siswaIds)->where('status', 'ditolak')->count(),
        ];

        return view('wali.dashboard', compact('izinPending', 'izinCount'));
    }

    // 🟩 Halaman semua izin (opsional, bisa dibuat daftar penuh)
    public function izinIndex()
    {
        $wali = Auth::guard('walikelas')->user();

        $siswaIds = Siswa::where('wali_kelas_id', $wali->id)->pluck('id');

        $izinList = Izin::whereIn('siswa_id', $siswaIds)
            ->with(['siswa', 'orangTua'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('walikelas.izin.index', compact('izinList'));
    }

    // 🟨 Ubah status izin (Disetujui / Ditolak)
    public function updateIzin(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'pesan'  => 'nullable|string|max:255'
        ]);


        $izin = Izin::findOrFail($id);
        $wali = Auth::guard('walikelas')->user();

        // pastikan izin milik siswa yang diawalinya
        if ($izin->siswa->wali_kelas_id !== $wali->id) {
            abort(403, 'Tidak diizinkan');
        }

        $izin->status = $request->status;
        $izin->save();

        return back()->with('success', 'Status izin berhasil diperbarui.');
    }

    // 🩵 Profil wali kelas
    public function profil()
    {
        $wali = Auth::guard('walikelas')->user();
        return view('walikelas.profil', compact('wali'));
    }
}
