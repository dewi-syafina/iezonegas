<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    public function __construct() { 
        $this->middleware(['auth:parent']);
    }

    // Tampilkan form & riwayat izin orang tua
    public function index(Request $request)
    {
        $parent = Auth::guard('parent')->user();
        $students = $parent->students()->with('classroom')->get();
        $izin = Izin::where('parent_id', $parent->id)
            ->with('siswa')
            ->orderBy('created_at','desc')
            ->get();

        return view('parent.izin.index', compact('students','izin'));
    }

    // Simpan pengajuan izin
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'jenis_izin' => 'required|string',
            'alasan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $parent = $request->user();
        $siswa = \App\Models\Siswa::findOrFail($request->siswa_id);

        // Upload bukti foto jika ada
        $buktiPath = $request->hasFile('bukti_foto')
            ? $request->file('bukti_foto')->store('bukti_izin', 'public')
            : null;

        // Simpan izin baru
        \App\Models\Izin::create([
            'siswa_id' => $siswa->id,
            'parent_id' => $parent->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jenis_izin' => $request->jenis_izin,
            'alasan' => $request->alasan,
            'bukti_foto' => $buktiPath,
            'status' => 'pending', // Belum diproses wali kelas
        ]);

        return redirect()->route('parent.dashboard')->with('success', 'Izin berhasil diajukan dan menunggu persetujuan wali kelas.');
    }

}
