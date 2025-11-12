<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Izin;

class OrangTuaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:parent');
    }

    /**
     * Dashboard Orang Tua
     */
    public function index()
{
    $parent = Auth::guard('parent')->user();

    // Ambil anak berdasarkan relasi (satu anak)
    $child = $parent->siswas()->with('kelas')->first();

    // Ambil izin anak kalau ada
    $izinList = $child
        ? Izin::with(['siswa.waliKelas', 'orangTua'])
            ->where('siswa_id', $child->id)
            ->orderBy('created_at', 'desc')
            ->get()
        : collect();

    // Hitung jumlah izin per status
    $izinCount = [
        'pending'  => $izinList->where('status', 'pending')->count(),
        'approved' => $izinList->where('status', 'approved')->count(),
        'rejected' => $izinList->where('status', 'rejected')->count(),
    ];

    return view('parent.dashboard', compact('child', 'izinList', 'izinCount'));
}

    /**
     * Form Pengajuan Izin
     */
    public function createIzin($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        return view('parent.izin.create', compact('siswa'));
    }

    /**
     * Simpan Pengajuan Izin
     */
    public function storeIzin(Request $request)
{
    $request->validate([
        'siswa_id' => 'required|exists:siswas,id',
        'jenis_izin' => 'required|in:ijin,sakit,dispensasi',
        'alasan' => 'required|string',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $parent = Auth::guard('parent')->user();
    $siswa = Siswa::findOrFail($request->siswa_id);

    $buktiPath = $request->hasFile('bukti_foto')
        ? $request->file('bukti_foto')->store('bukti_izin', 'public')
        : null;

    $lastIzin = Izin::orderBy('id', 'desc')->first();
    $nextNumber = $lastIzin ? str_pad($lastIzin->id + 1, 3, '0', STR_PAD_LEFT) : '001';
    $nomorSurat = 'IZIN/' . date('Y') . '/' . $nextNumber;

    Izin::create([
        'siswa_id' => $siswa->id,
        'parent_id' => $parent->id,
        'jenis_izin' => $request->jenis_izin,
        'alasan' => $request->alasan,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
        'bukti_foto' => $buktiPath,
        'status' => 'pending',
        'nomor_surat' => $nomorSurat,
        'tanggal_pengajuan' => now(),
    ]);

    return redirect()
        ->route('parent.dashboard')
        ->with('success', '✅ Izin telah terkirim ke wali kelas dan sedang menunggu persetujuan.');
}

}
