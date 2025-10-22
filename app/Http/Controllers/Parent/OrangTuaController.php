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

        // Jika anak ditemukan, ambil izinnya
        $izins = $child
            ? Izin::where('siswa_id', $child->id)->latest()->get()
            : collect();

        return view('parent.dashboard', compact('child', 'izins'));
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

        // Simpan bukti foto ke storage/public/bukti_izin
        $buktiPath = $request->file('bukti_foto')->store('bukti_izin', 'public');

        // Simpan data izin ke database
        Izin::create([
            'siswa_id' => $request->siswa_id,
            'parent_id' => $parent->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jenis_izin' => $request->jenis_izin, // sudah terpisah
            'alasan' => $request->alasan,
            'bukti_foto' => $buktiPath,
            'status' => 'Pending',
        ]);
        return redirect()->route('parent.dashboard')
            ->with('success', 'Pengajuan izin berhasil dikirim dan menunggu persetujuan.');
    }
}
