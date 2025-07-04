<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Jobs\InitializeLessonProgress;
use Illuminate\Contracts\View\View;
use App\Http\Requests\EnrollStudentRequest;

class CourseController extends Controller {

    public function index(): View {
        $items = Course::paginate(6);
        return view('courses.index')->with(compact('items'));
    }

    public function show(string $slug): View {
        $item = Course::with('lessons')->where('slug', $slug)->firstOrFail();
        return view('courses.show')->with(compact('item'));
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

            Enrollment::create(['user_id' => $user->id, 'course_id' => $courseId]);
            InitializeLessonProgress::dispatch($user, $course);
            $message = ['success' => __('Enrollment successful!')];
        } catch (\Throwable $e) {
            \Log::error("Failed to enroll user {$user->id} in course {$courseId}: {$e->getMessage()}");

            $message = ['error' => __('Enrollment failed. Please try again later.')];
        }

        return redirect()->route('courses.show', $course->slug)->with($message);
    }
}
