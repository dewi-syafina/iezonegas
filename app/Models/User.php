<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'nis', 'nip'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi untuk siswa
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id');
    }

    
    // Relasi orang tua ke anak via ParentChild
    public function children()
    {
        return $this->hasManyThrough(
            Siswa::class,
            ParentChild::class,
            'parent_id', // parent_id di parent_child
            'id',        // id di siswas
            'id',        // id di users
            'student_id' // student_id di parent_child
        );
    }
}
