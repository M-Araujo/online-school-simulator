<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Services\LessonService;
use Illuminate\Support\Facades\Log;
use App\Jobs\InitializeLessonProgress;
use Illuminate\Contracts\View\View;
use App\Http\Requests\EnrollStudentRequest;

class CourseController extends Controller {

    public function index(): View {
        $items = Course::paginate(6);
        return view('courses.index')->with(compact('items'));
    }

    public function show(string $slug): View {
        $user = $this->authenticatedUser;
        $item = Course::with(['lessons.progress' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->where('slug', $slug)->firstOrFail();

        $lessonService = new LessonService();
        $currentLesson = $lessonService->getCurrentLesson($item);

        return view('courses.show')->with(compact('item', 'currentLesson'));
    }

    public function studentCourses(): View {
        $items = $this->authenticatedUser->enrolledCourses()->paginate(6);
        return view('courses.student-courses')->with(compact('items'));
    }

    public function enrollStudent(EnrollStudentRequest $request) {
        $courseId = $request->input('course_id');
        $user = $this->authenticatedUser;

        try {
            $course = Course::findOrFail($courseId);
            $message = ['success' => __('Enrollment successful!')];

            Enrollment::create(['user_id' => $user->id, 'course_id' => $courseId]);
            InitializeLessonProgress::dispatch($user, $course);
        } catch (\Throwable $e) {
            $message = ['error' => __('Enrollment failed. Please try again later.')];
            Log::error("Failed to enroll user {$user->id} in course {$courseId}: {$e->getMessage()}");
        }

        return redirect()->route('courses.show', $course->slug)->with($message);
    }
}
