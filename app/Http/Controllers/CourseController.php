<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{
    public function index(){
        $items = Course::paginate(6);
        return view('courses.index')->with(compact('items'));
    }
}
