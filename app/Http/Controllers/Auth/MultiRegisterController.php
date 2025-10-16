<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MultiRegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|in:siswa,parent,wali',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // Simpan user umum
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Simpan ke tabel sesuai role
        switch ($request->role) {
            case 'siswa':
                Siswa::create(['user_id' => $user->id]);
                break;
            case 'parent':
                OrangTua::create(['user_id' => $user->id]);
                break;
            case 'wali':
                Wali::create(['user_id' => $user->id]);
                break;
        }

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
