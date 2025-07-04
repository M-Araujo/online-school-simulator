<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
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

    protected static function booted() {
        static::creating(function ($course) {
            $course->slug = Str::slug($course->title);
        });

        static::updating(function ($course) {
            if ($course->isDirty('title')) {
                $course->slug = Str::slug($course->title);
            }
        });
    }

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function enrolledStudents() {
        return $this->hasMany(User::class, 'user_id');
    }

    public function lessons() {
        return $this->hasMany(Lesson::class, 'course_id')->orderBy('position');
    }
}
