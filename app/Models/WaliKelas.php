<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class WaliKelas extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['nama', 'nip', 'email', 'password'];

    public function kelas() {
        return $this->hasMany(Kelas::class);
    }
}
