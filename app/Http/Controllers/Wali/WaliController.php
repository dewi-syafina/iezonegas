<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;

class WaliController extends Controller
{
    public function dashboard()
    {
        return view('wali.dashboard');
    }

    public function izin()
    {
        return view('wali.izin.index');
    }

    public function profil()
    {
        return view('wali.profil');
    }
}
