<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ParentRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register-parent');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:orangtuas,email',
            'password'   => 'required|string|confirmed|min:6',
            'child_nis'  => 'required|exists:siswas,nis',
        ]);

        // Simpan ke tabel orangtuas
        $parent = OrangTua::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'nis_anak' => $request->child_nis, // tambahkan baris ini
        ]);

        // Hubungkan dengan anak
        $siswa = Siswa::where('nis', $request->child_nis)->first();
        if ($siswa) {
            $siswa->parent_id = $parent->id;
            $siswa->save();
        }

        // Login otomatis dengan guard parent
        Auth::guard('parent')->login($parent);

        return redirect()->route('parent.dashboard')->with('success', 'Registrasi orang tua berhasil!');
    }
}
