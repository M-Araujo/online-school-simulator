<?php

use App\Models\Course;

test('unauthenticated users are redirected to login when entering the url', function () {
    $this->get('/courses')->assertRedirect('/login');
});

test('loads the course data for admin users', function () {
    createAndActAsAdmin();
    $this->get('/courses')->assertStatus(200);
});

test('loads the course data for teacher users', function () {
    createAndActAsTeacher();
    $this->get('/courses')->assertStatus(200);
});

test('loads the course data for students users', function () {
    createAndActAsStudent();
    $this->get('/courses')->assertStatus(200);
});

test('admins enter the page and see a list of items', function () {
    createAndActAsAdmin();
    $courses = createRecords(Course::class, 3);
    $response = $this->get('/courses');

    foreach ($courses as $course) {
        $response->assertSee($course->title)->assertSee($course->description);
    }
    $response->assertStatus(200);
});


