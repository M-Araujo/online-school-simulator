<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'video_url',
        'position',
        'course_id',
        'created_at',
        'updated_at'
    ];

    public function course() {
        return $this->hasOne(Course::class, 'course_id');
    }
}
