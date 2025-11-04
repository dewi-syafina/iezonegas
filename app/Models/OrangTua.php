<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrangTua extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'orangtuas';

    protected $fillable = [
        'name',
        'email',
        'password',
        'nis_anak',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'parent_id');
    }
}
