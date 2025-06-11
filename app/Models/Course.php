<?php

namespace App\Models;

class Course 
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'teacher_id',
        'role',
        'description',
        'duration_hours',
        'content',
        'start_date',
        'end_date',
        'schedule',
        'is_published',
        'created_at',
        'updated_at'
    ];

  
}
