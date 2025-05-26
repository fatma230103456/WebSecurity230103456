<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades';

    protected $fillable = [
        'student_id',
        'course_id',
        'grade'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}