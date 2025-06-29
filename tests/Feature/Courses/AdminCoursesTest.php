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
