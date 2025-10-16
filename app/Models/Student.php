<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;


    protected $fillable = ['user_id','parent_id','classroom_id','name','nis'];


    public function user() { return $this->belongsTo(User::class,'user_id'); }
    public function parent() { return $this->belongsTo(User::class,'parent_id'); }
    public function classroom() { return $this->belongsTo(Classroom::class); }
    public function izinRequests() { return $this->hasMany(IzinRequest::class,'student_id'); }
}
