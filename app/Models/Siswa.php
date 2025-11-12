<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Siswa extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['nama', 'nis', 'jenis_kelamin', 'email', 'password', 'kelas_id', 'orang_tua_id'];

    protected $hidden = ['password'];

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    public function orangTua() {
        return $this->belongsTo(OrangTua::class);
    }

    public function izin() {
        return $this->hasMany(Izin::class);
    }
}
