<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:wali_kelas']);
    }

    // Menampilkan semua izin dari siswa yang berada di kelas wali kelas ini
    public function index()
    {
        $wali = Auth::user();

        // Ambil semua siswa yang wali_kelas_id-nya sama dengan user yang login
        $siswas = Siswa::where('wali_kelas_id', $wali->id)->pluck('id');

        // Ambil semua izin dari siswa-siswa tersebut
        $izins = Izin::whereIn('siswa_id', $siswas)
            ->with(['siswa', 'orangTua'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('wali.izin.index', compact('izins'));
    }

    // Wali kelas menyetujui atau menolak izin
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $izin = Izin::findOrFail($id);

        // Pastikan izin ini memang milik siswa yang diawasi wali kelas ini
        $wali = Auth::user();
        if ($izin->siswa->wali_kelas_id !== $wali->id) {
            abort(403, 'Anda tidak berhak memproses izin ini.');
        }

        $izin->status = $request->status;
        $izin->save();

        return redirect()->route('wali.izin.index')->with('success', 'Status izin berhasil diperbarui.');
    }
}
