<?php

namespace App\Models;

class Enrolment 
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'course_id',
        'enroled_at',
        'completed',
        'created_at',
        'updated_at'
    ];

  
}
