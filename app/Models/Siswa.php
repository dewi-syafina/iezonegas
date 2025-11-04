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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    //public function waliKelas()
    //{
      //  return $this->belongsTo(User::class, 'wali_kelas_id');
    //}

    public function izins()
    {
        return $this->hasMany(Izin::class, 'siswa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orangtua()
    {
        return $this->belongsTo(OrangTua::class, 'parent_id');
    }


    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

}
