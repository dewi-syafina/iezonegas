<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas'; // pastikan nama tabelnya benar
    protected $fillable = ['nama_kelas']; // sesuaikan kolom yang kamu punya
}
