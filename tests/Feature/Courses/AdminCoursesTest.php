<?php

use App\Models\Course;

test('admins enter the page and see a list of items', function () {
    createAndActAsRole('admin');
    $courses = createRecords(Course::class, 3);
    $response = $this->get('/courses')
        ->assertStatus(200)
        ->assertSee('course-card');

    assertCoursesVisible($response, $courses);
});

test('loads the course data for admin users', function () {
    createAndActAsRole('admin');
    $this->get('/courses')->assertStatus(200);
});

test('guarantees the admin cannot see the my courses page', function () {
    createAndActAsRole('admin');
    $this->get('/student-courses')->assertRedirect('/dashboard');
});


test('if an admin enters the courses list button displays "Details" always', function () {

    createAndActAsRole('admin');
    $course = createUpcomingCourse();

    $this->get('/courses')
        ->assertSee($course->title)
        ->assertSee('Details');
});

test('if an admin enters the courses list button should never display "Continue learning"', function () {

    createAndActAsRole('admin');
    $course = createUpcomingCourse();

    $this->get('/courses')
        ->assertSee($course->title)
        ->assertDontSee('Continue learning');
});
