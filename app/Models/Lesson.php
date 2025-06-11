<?php

namespace App\Models;

class Lesson 
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
        'content',
        'video_url',
        'position',
        'course_id',
        'created_at',
        'updated_at'
    ];

  
}
