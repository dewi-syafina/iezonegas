<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OrangTua extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'orangtuas';

    protected $fillable = [
        'name',
        'nis_anak',
        'email',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // relasi otomatis ke siswa berdasarkan NIS
    public function anak()
    {
        return $this->hasOne(Siswa::class, 'nis', 'nis_anak');
    }

    public function izins()
    {
        return $this->hasMany(Izin::class, 'parent_id');
    }
}
