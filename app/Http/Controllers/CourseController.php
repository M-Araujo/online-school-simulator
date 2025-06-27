<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EnrollStudentRequest;

class CourseController extends Controller {

    protected $authenticatedUser;
    public function __construct() {
        $this->authenticatedUser = Auth::user();
    }

    public function index(): View {
        $items = Course::paginate(6);
        return view('courses.index')->with(compact('items'));
    }

    public function show(string $slug): View {
        $item = Course::where('slug', $slug)->firstOrFail();
        return view('courses.show')->with([
            'item' => $item,
            'authenticatedUser' => $this->authenticatedUser,
        ]);
    }

    public function studentCourses(): View {
        $items = $this->authenticatedUser->enrolledCourses;
        return view('courses.student-courses')->with(compact('items'));
    }

    public function enrollStudent(EnrollStudentRequest $request) {
        Enrollment::create(['user_id' => $this->authenticatedUser->id, 'course_id' => $request->input('course_id')]);
        return redirect()->back()->with('success', 'Enrollment successful!');
    }
}
