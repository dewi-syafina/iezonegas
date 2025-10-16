<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParentRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'child_nis' => 'required|exists:siswas,nis',
        ]);

        // Simpan user orang tua
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'parent',
        ]);

        // Hubungkan dengan anak
        $siswa = Siswa::where('nis', $request->child_nis)->first();
        if ($siswa) {
            $siswa->parent_id = $user->id;
            $siswa->save();
        }

        return redirect()->route('parent.login')->with('success', 'Registrasi orang tua berhasil! Silakan login.');
    }
}
