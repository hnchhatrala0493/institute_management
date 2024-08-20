<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model {
    use HasFactory;
    protected $fillable = [];
    protected $table = 'departments';

    public function departments() {
        return $this->belongsTo( Department::class, 'department_id' );
    }
}
