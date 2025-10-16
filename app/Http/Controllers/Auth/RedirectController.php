<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function redirect()
{
    if (Auth::guard('siswa')->check()) {
        return redirect()->route('siswa.dashboard');
    }

    if (Auth::guard('orangtua')->check()) {
        return redirect()->route('orangtua.dashboard');
    }

    if (Auth::guard('walikelas')->check()) {
        return redirect()->route('walikelas.dashboard');
    }

    return redirect()->route('login')->with('error', 'Anda belum login.');
}

}
