<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model {
    use HasFactory;
    protected $fillable = [ 'student_id', 'teacher_id', 'present_date', 'absent_date' ];
    protected $table = 'attendances';
}
