<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool {
        return $this->role === 'admin';
    }

    public function isTeacher(): bool {
        return $this->role === 'teacher';
    }

    public function isStudent(): bool {
        return $this->role === 'student';
    }

    public function teachingCourses(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function enrolledCourses(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
        return $this->belongsToMany(Course::class, 'enrollments');
    }

    public function upcomingEnrolledCourses(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->enrolledCourses()->whereHas('course', function ($query) {
            $query->where('start_date', '>', now());
        });
    }
}
