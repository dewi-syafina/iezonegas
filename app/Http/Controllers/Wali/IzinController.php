<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IzinRequest;

class IzinController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:wali_kelas']);
    }

    // Tampilkan semua izin yang masuk untuk wali kelas login
    public function index(Request $request)
    {
        $wali = $request->user();

        $izin = IzinRequest::where('wali_id', $wali->id)
            ->with('student','parent')
            ->orderBy('created_at','desc')
            ->get();

        return view('wali.izin.index', compact('izin'));
    }

    // Update status izin (Setujui/Tolak)
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diizinkan,Ditolak'
        ]);

        $izin = IzinRequest::findOrFail($id);

        // pastikan wali hanya bisa memutuskan izin yg masuk ke dia
        if ($izin->wali_id != $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $izin->status = $request->status;
        $izin->save();

        return redirect()->route('wali.izin.index')->with('success','Keputusan izin berhasil disimpan.');
    }
}
