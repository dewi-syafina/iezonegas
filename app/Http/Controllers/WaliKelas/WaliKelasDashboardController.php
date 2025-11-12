<?php
namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Izin;

class WaliKelasDashboardController extends Controller
{
    public function dashboard()
{
    $wali = auth('walikelas')->user();
    $izins = Izin::with('siswa')->latest()->get();

    return view('wali.dashboard', compact('wali', 'izins'));
}

    public function izinIndex()
    {
        $izins = Izin::latest()->get();
        return view('wali.izin.index', compact('izins'));
    }

    public function updateIzin(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diizinkan,tidak diizinkan',
        ]);

        $izin = Izin::findOrFail($id);
        $izin->status = $request->status;
        $izin->save();

        return redirect()->back()->with('status', 'Status izin berhasil diperbarui!');
    }
}
