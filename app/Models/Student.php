<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {
    use HasFactory;
    protected $fillable = [ 'department_id', 'user_id' ] ;
    protected $table = 'students';

    public function users() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    public function departments() {
        return $this->belongsTo( Department::class, 'department_id' );
    }
}
