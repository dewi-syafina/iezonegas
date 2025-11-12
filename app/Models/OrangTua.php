<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class OrangTua extends Authenticatable 
{
    use HasFactory;
    protected $fillable = ['nama', 'siswa_id', 'email', 'password'];
    protected $hidden = ['password'];
    

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function izin() {
        return $this->hasMany(Izin::class);
    }
}
