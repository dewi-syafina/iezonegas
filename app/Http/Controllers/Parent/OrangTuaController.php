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

        // ambil data anak otomatis dari NIS
        $child = Siswa::where('nis', $parent->nis_anak)->first();

        // ambil semua izin anak
        $izins = $child
            ? Izin::where('siswa_id', $child->id)->latest()->get()
            : collect();

        return view('parent.dashboard', compact('child', 'izins'));
    }

    public function createIzin($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        return view('parent.izin.create', compact('siswa'));
    }

    public function storeIzin(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jenis_izin' => 'required|string',
            'alasan' => 'required|string',
            'bukti_foto' => 'required|image|max:2048',
        ]);

        $parent = Auth::user();
        $buktiPath = $request->file('bukti_foto')
            ? $request->file('bukti_foto')->store('bukti', 'public')
            : null;

        Izin::create([
            'siswa_id' => $request->siswa_id,
            'parent_id' => $parent->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jenis_izin' => $request->jenis_izin,
            'alasan' => $request->alasan,
            'bukti_foto' =>  $path ?? null,
            'status' => 'Pending',
        ]);

        return redirect()->route('orangtua.dashboard')->with('success', 'Pengajuan izin berhasil dikirim.');
    }
}
