<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
                if ($parent->siswas->isEmpty()) {
            return redirect()->route('parent.dashboard')->with('error', 'Anda belum memiliki anak yang terdaftar.');
        }

        $students = $parent->students()->with('kelas')->get(); // pastikan relasi 'kelas' sesuai
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
                'siswa_id' => 'required',
                'jenis_izin' => 'required',
                'alasan' => 'required',
                'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $parent = Auth::guard('parent')->user();

            // 🔹 Buat nomor surat otomatis
            $lastIzin = Izin::latest()->first();
            $nextNumber = $lastIzin ? str_pad($lastIzin->id + 1, 3, '0', STR_PAD_LEFT) : '001';
            $nomorSurat = 'IZIN/' . date('Y') . '/' . $nextNumber;

            $data = [
                'siswa_id' => $request->siswa_id,
                'parent_id' => $parent->id,
                'jenis_izin' => $request->jenis_izin,
                'alasan' => $request->alasan,
                'nomor_surat' => $nomorSurat,
                'tanggal_pengajuan' => Carbon::now()->format('Y-m-d'),
                'status' => 'pending',
            ];

            if ($request->hasFile('bukti_foto')) {
                $data['bukti_foto'] = $request->file('bukti_foto')->store('bukti_izin', 'public');
            }

            Izin::create($data);

            return redirect()
                ->route('parent.dashboard')
                ->with('success', '✅ Izin telah terkirim ke wali kelas dan sedang menunggu persetujuan.');
        }
    
}
