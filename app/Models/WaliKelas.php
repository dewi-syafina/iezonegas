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
        'nama',
        'nip',
        'email',
        'password',
    ];
    protected $hidden = ['password', 'remember_token'];
}
