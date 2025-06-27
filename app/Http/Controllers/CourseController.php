<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller {
    public function index(): View {
        $items = Course::paginate(6);
        return view('courses.index')->with(compact('items'));
    }

    public function show(string $slug): View {
        $user = Auth::user();
        $item = Course::where('slug', $slug)->firstOrFail();
        return view('courses.show')->with(compact('item', 'user'));
    }

    public function studentCourses(): View {
        $user = Auth::user();
        $items = $user->enrolledCourses;
        return view('courses.student-courses')->with(compact('items'));
    }

    public function enrollStudent(Request $request) {
        $user = Auth::user();
        Enrollment::create(['user_id' => $user->id, 'course_id' => $request->input('course_id')]);
        return redirect()->back();
    }
}
