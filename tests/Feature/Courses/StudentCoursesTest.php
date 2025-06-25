<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('students should be able to see the enroll button', function () {

    createRecords(Course::class, 3);
    createAndActAsStudent();

    $response = $this->get('/courses')->assertStatus(200);
    $response->assertSee('Details', escape: false);
});

test('student sees the correct link to course details', function () {

    createAndActAsStudent();

    $course = createRecords(Course::class, 1);
    $detailsUrl = route('courses.show', $course->first()->slug);

    $this->get('/courses')
        ->assertStatus(200)
        ->assertSee('href="' . $detailsUrl . '"', escape: false);
});

test('student access the course details page', function () {
    createAndActAsStudent();
    $course = createRecords(Course::class, 1);
    $this->get(route('courses.show', $course->first()->slug))->assertSee($course->first()->title);
});

test('student sees their enrolled courses list', function () {
    $student = createAndActAsStudent();
    $courses = createRecords(Course::class, 4);

    enrollStudentInCourses($student, $courses);

    $response = $this->get('/my-courses')
        ->assertStatus(200)
        ->assertSee('My courses');

    assertCoursesVisible($response, $courses);
});

test('loads the course data for students users', function () {
    createAndActAsStudent();
    $this->get('/courses')->assertStatus(200);
});


// todo add test when no courses exist

//Confirm the student cannot see courses they aren’t enrolled in