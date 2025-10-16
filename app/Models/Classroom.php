<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = ['name','wali_kelas_id'];


    public function waliKelas() { return $this->belongsTo(User::class,'wali_kelas_id'); }
    public function students() { return $this->hasMany(Student::class); }
}
