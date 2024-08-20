<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {
    use HasFactory;
    protected $fillable = [ 'department_id', 'user_id', 'subject_id', 'created_id' ] ;
    protected $table = 'teachers';

    public function teachers() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    public function departments() {
        return $this->belongsTo( Department::class, 'department_id' );
    }

    public function subjects() {
        return $this->belongsTo( Subject::class, 'subject_id' );
    }
}
