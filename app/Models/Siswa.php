<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';
    protected $fillable = ['nama', 'nis', 'kelas', 'email', 'user_id'];

    // Jika ada relasi dengan user siswa
   public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}


public function izins()
{
    return $this->hasMany(\App\Models\Izin::class, 'siswa_id');
}


}
