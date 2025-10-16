<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinRequest extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','parent_id','wali_kelas_id','reason','start_date','end_date','status','teacher_comment'];


    public function student() { return $this->belongsTo(Student::class); }
    public function parent() { return $this->belongsTo(User::class,'parent_id'); }
    public function waliKelas() { return $this->belongsTo(User::class,'wali_kelas_id'); }
}
