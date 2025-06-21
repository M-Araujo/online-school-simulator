<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(){
       $courses = Course::paginate(10);
       return view('courses.index')->with(compact('courses'));
    }
}
