<?php

namespace App\Http\Controllers\parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Izin;

class OrangTuaDashboardController extends Controller
{
    // Dashboard utama parent
    public function dashboard()
    {
        $parent = Auth::guard('parent')->user();

        // Ambil semua siswa yang terkait dengan parent ini
        $siswaList = Siswa::where('orang_tua_id', $parent->id)->get();

        // Ambil semua izin anak-anak parent
        $izinList = Izin::whereIn('siswa_id', $siswaList->pluck('id'))->latest()->get();

        return view('parent.dashboard', compact('parent', 'siswaList', 'izinList'));
    }

    // Profil parent
    public function profil()
    {
        $parent = Auth::guard('parent')->user();
        return view('parent.profil', compact('parent'));
    }

    // Form ajukan izin
    public function createIzin(Siswa $siswa)
    {
        $parent = Auth::guard('parent')->user();

        // Pastikan siswa yang dipilih anak dari parent ini
        if ($siswa->orang_tua_id !== $parent->id) {
            abort(403, 'Anda tidak memiliki akses ke siswa ini.');
        }

        // Perbaiki variabel yang dikirim ke view
        return view('parent.izin.create', ['siswa' => $siswa]);
    }

    // Simpan izin baru
    public function storeIzin(Request $request)
    {
        $request->validate([
            // Ganti 'siswa' menjadi 'siswas' sesuai nama tabel di DB
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'jenis_izin' => 'required|string',
            'alasan' => 'required|string',
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $parent = Auth::guard('parent')->user();

        $siswa = Siswa::findOrFail($request->siswa_id);

        // Pastikan siswa milik parent
        if ($siswa->orang_tua_id !== $parent->id) {
            abort(403, 'Anda tidak memiliki akses ke siswa ini.');
        }

        $izin = new Izin();
        $izin->siswa_id = $siswa->id;
        $izin->orang_tua_id = $parent->id;
        $izin->tanggal = $request->tanggal;
        $izin->jenis_izin = $request->jenis_izin;
        $izin->alasan = $request->alasan;

        // Upload bukti jika ada
        if ($request->hasFile('bukti')) {
            $izin->bukti = $request->file('bukti')->store('izin', 'public');
        }

        $izin->status = 'pending';
        $izin->save();

        return redirect()->route('parent.dashboard')->with('success', 'Izin berhasil diajukan!');
    }
}
