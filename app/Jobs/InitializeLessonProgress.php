<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\LessonProgress;
use App\Models\Course;
use App\Models\User;

class InitializeLessonProgress implements ShouldQueue {
    use Queueable;

    protected $user;
    protected $course;

    public function __construct(User $user, Course $course) {
        $this->user = $user;
        $this->course = $course;
    }

    public function handle(): void {
        $this->course->loadMissing('lessons');

        try {
            DB::transaction(function () {
                foreach ($this->course->lessons as $lesson) {
                    LessonProgress::firstOrCreate([
                        'user_id' => $this->user->id,
                        'lesson_id' => $lesson->id,
                    ], [
                        'status' => 'not_started',
                    ]);
                }
            });

            Log::info("Initialized lesson progress for user {$this->user->id} in course {$this->course->id}");
        } catch (\Throwable $e) {
            Log::error("Failed to initialize lesson progress for user {$this->user->id}: {$e->getMessage()}");
            throw $e;
        }
    }
}
