<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonProgress extends Model {
    protected $fillable = [
        'user_id',
        'lesson_id',
        'status',
        'completed_at',
    ];
}
