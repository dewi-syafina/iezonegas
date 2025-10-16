<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IzinRequest;
use App\Models\Student;

class IzinController extends Controller
{
    public function __construct() { $this->middleware(['auth','role:orang_tua']); }


    // Tampilkan form & riwayat
    public function index(Request $request)
        {
            $parent = $request->user();
            $students = $parent->students()->with('classroom')->get();
            $izin = IzinRequest::where('parent_id', $parent->id)->with('student','waliKelas')->orderBy('created_at','desc')->get();
            return view('parent.izin.index', compact('students','izin'));
        }


    public function store(Request $request)
    {
        
    }
}
