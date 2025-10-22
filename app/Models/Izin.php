<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $table = 'izins';

    protected $fillable = [
        'siswa_id',
        'parent_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'jenis_izin',
        'alasan',
        'bukti_foto',
        'status',
    ];

    // Relasi ke siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Relasi ke orang tua
    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class, 'parent_id');
    }

    // 🔧 Relasi ke wali kelas lewat tabel siswa
    public function waliKelas()
    {
        // Izin -> Siswa -> wali_kelas_id
        return $this->hasOneThrough(
            WaliKelas::class, // model tujuan
            Siswa::class,     // model perantara
            'id',             // Foreign key di tabel siswa (relasi ke izin)
            'id',             // Foreign key di tabel wali_kelas (relasi ke siswa)
            'siswa_id',       // Foreign key di tabel izin
            'wali_kelas_id'   // Kolom di tabel siswa yang menunjuk wali kelas
        );
    }
}
