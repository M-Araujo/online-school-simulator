<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
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
        $course = Course::findOrFail($request->input('course_id'));

        Enrollment::create(['user_id' => $this->authenticatedUser->id, 'course_id' => $request->input('course_id')]);
        return redirect()->route('courses.show', $course->slug)
            ->with('success', 'Enrollment successful!');
    }
}
