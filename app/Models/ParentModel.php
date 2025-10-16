<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ParentModel extends Authenticatable
{
    use Notifiable;

    // ✅ arahkan ke tabel 'orangtuas'
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
}
