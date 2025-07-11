<?php

use App\Models\Course;

test('admins enter the page and see a list of items', function () {
    createAndActAsRole('admin');
    $courses = createRecords(Course::class, 3);
    $response = loadPageAndAssertOk('/courses')
        ->assertSee('course-card');

    assertCoursesVisible($response, $courses);
});

test('loads the course data for admin users', function () {
    createAndActAsRole('admin');
    loadPageAndAssertOk('/courses');
});

test('guarantees the admin cannot see the my courses page', function () {
    createAndActAsRole('admin');
    $this->get('/student-courses')->assertRedirect('/dashboard');
});


test('if an admin enters the courses list button displays "Details" always', function () {

    createAndActAsRole('admin');
    createUpcomingCourse();

    loadPageAndAssertOk('/courses')
        ->assertSee('Details');
});

test('if an admin enters the courses list button should never display "Continue learning"', function () {

    createAndActAsRole('admin');
    createUpcomingCourse();

    loadPageAndAssertOk('/courses')
        ->assertDontSee('Continue learning');
});

test('if an admin enters the courses detail page, should see the course title', function () {

    createAndActAsRole('admin');
    $course = createUpcomingCourse();

    loadPageAndAssertOk('/courses')
        ->assertSee($course->title);
});
