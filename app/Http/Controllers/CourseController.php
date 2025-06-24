<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller {
    public function index() {
        $items = Course::paginate(6);
        return view('courses.index')->with(compact('items'));
    }

    public function show($slug) {
        $item = Course::where('slug', $slug)->firstOrFail();
        return view('courses.show')->with(compact('item'));
    }
}
