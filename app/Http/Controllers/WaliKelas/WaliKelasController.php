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

        // Ambil semua siswa yang dibimbing wali kelas ini
        $siswaIds = Siswa::where('wali_kelas_id', $wali->id)->pluck('id');

        // Ambil izin pending untuk ditampilkan
        $izinPending = Izin::whereIn('siswa_id', $siswaIds)
            ->where('status', 'pending')
            ->with(['siswa', 'orangTua'])
            ->latest()
            ->get();

        // Ambil semua izin (riwayat)
        $izinAll = Izin::whereIn('siswa_id', $siswaIds)
            ->with(['siswa', 'orangTua'])
            ->latest()
            ->get();

        // Hitung total izin berdasarkan status enum di DB
        $izinCount = [
            'pending'   => Izin::whereIn('siswa_id', $siswaIds)->where('status', 'pending')->count(),
            'disetujui' => Izin::whereIn('siswa_id', $siswaIds)->where('status', 'approved')->count(),
            'ditolak'   => Izin::whereIn('siswa_id', $siswaIds)->where('status', 'rejected')->count(),
        ];

        // Kirim semua data ke view
        return view('wali.dashboard', compact('izinPending', 'izinAll', 'izinCount'));
    }

    // 🟨 Update status izin (disetujui / ditolak)
    public function updateIzin(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'pesan'  => 'nullable|string|max:255',
        ]);

        $izin = Izin::findOrFail($id);
        $wali = Auth::guard('walikelas')->user();

        // Cek apakah izin ini benar milik siswa di bawah wali kelas ini
        if ($izin->siswa->wali_kelas_id !== $wali->id) {
            abort(403, 'Tidak diizinkan');
        }

        // Ubah agar sesuai enum di database
        $izin->status = $request->status === 'disetujui' ? 'approved' : 'rejected';
        $izin->pesan_wali = $request->pesan;
        $izin->save();

        // Redirect ke dashboard dengan notifikasi
        return redirect()->route('walikelas.dashboard')
            ->with('success', '✅ Status izin berhasil diperbarui!');
    }

    // 🩵 Profil wali kelas
    public function profil()
    {
        $wali = Auth::guard('walikelas')->user();
        return view('wali.profil', compact('wali'));
    }
}
