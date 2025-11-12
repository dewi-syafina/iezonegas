<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;
    protected $fillable = ['siswa_id', 'orang_tua_id', 'tanggal', 'jenis_izin', 'alasan', 'bukti', 'status'];

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function orangTua() {
        return $this->belongsTo(OrangTua::class);
    }
}
