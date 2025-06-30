<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Lesson;
use App\Policies\LessonPolicy;
use App\Policies\CoursePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Lesson::class => LessonPolicy::class,
        Course::class => CoursePolicy::class
        // Register other model policies here
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void {
        $this->registerPolicies();

        // You can define Gates here if needed, e.g.:
        // Gate::define('update-lesson', function ($user, $lesson) {
        //     return $user->id === $lesson->teacher_id;
        // });
    }
}
