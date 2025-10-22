<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'siswas';

    protected $fillable = [
        'wali_kelas_id',
        'user_id',
        'nama',
        'nis',
        'email',
        'jenis_kelamin',
        'kelas_id',
        'parent_id',
        'jurusan',
        'password',
    ];

    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id');
    }

    public function izins()
    {
        return $this->hasMany(Izin::class, 'siswa_id');
    }
}
