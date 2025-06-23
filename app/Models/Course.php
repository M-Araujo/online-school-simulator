<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
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

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function enrolledStudents()
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
