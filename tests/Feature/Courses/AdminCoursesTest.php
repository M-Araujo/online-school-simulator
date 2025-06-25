<?php

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admins enter the page and see a list of items', function () {
    createAndActAsAdmin();
    $courses = createRecords(Course::class, 3);
    $response = $this->get('/courses');

    foreach ($courses as $course) {
        $response->assertSee($course->title);
        $response->assertSee(Str::limit($course->description, 100));
    }

    $response->assertSee('course-card');
    $response->assertStatus(200);
});

test('loads the course data for admin users', function () {
    createAndActAsAdmin();
    $this->get('/courses')->assertStatus(200);
});
