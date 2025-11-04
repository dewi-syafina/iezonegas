<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class WaliKelas extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'wali_kelas';

     protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'email',
        //'password',
    ];
    protected $hidden = ['password', 'remember_token'];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'wali_kelas_id');
    }

     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
