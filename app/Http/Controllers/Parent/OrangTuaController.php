<?php

namespace App\Http\Controllers\Parent;

use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Izin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrangTuaController extends Controller
{
    public function index()
    {
        $parent = Auth::user();

        // Ambil anak berdasarkan NIS yang sama
        $child = Siswa::where('nis', $parent->nis_anak)->first();

        // Ambil seluruh izin anak (jika anak ditemukan)
        $izins = $child
            ? Izin::where('siswa_id', $child->id)->orderBy('created_at', 'desc')->get()
            : collect();

        // Hitung jumlah izin berdasarkan status
        $izinCount = [
            'pending'   => $izins->where('status', 'pending')->count(),
            'approved'  => $izins->where('status', 'approved')->count(),
            'rejected'  => $izins->where('status', 'rejected')->count(),
        ];

        return view('parent.dashboard', compact('child', 'izins', 'izinCount'));
    }

    public function createIzin($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        return view('parent.Izin.create', compact('siswa'));
    }

    public function storeIzin(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'jenis_izin' => 'required|string|in:ijin,sakit,dispensasi',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:255',
            'bukti_foto' => 'required|image|max:2048',
        ]);

        $parent = Auth::user();
        $buktiPath = $request->file('bukti_foto')->store('bukti_izin', 'public');

        Izin::create([
            'siswa_id' => $request->siswa_id,
            'parent_id' => $parent->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jenis_izin' => $request->jenis_izin,
            'alasan' => $request->alasan,
            'bukti_foto' => $buktiPath,
            'status' => 'pending', // enum di DB lowercase
        ]);

        return redirect()->route('parent.dashboard')
            ->with('success', '✅ Pengajuan izin berhasil dikirim dan menunggu persetujuan wali kelas.');
    }
}
