<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{
    public function index(){
        $items = Course::paginate(10);
        return view('courses.index')->with(compact('items'));
    }
}
