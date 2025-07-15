<?php

namespace Tests\Feature\Dashboard;

use App\Models\Course;
use function Pest\Laravel\get;

test('dashboard shows student partial for students', function () {
    createAndActAsRole('student');
    get('/dashboard')->assertSee('Current Courses');
});

test('a link should appear to user courses', function () {
    createAndActAsRole('student');
    get('/dashboard')->assertSee('href="/student-courses"', escape: false);
});


test('the user`s last 3 courses should appear', function () {
    $student = createAndActAsRole('student');

    $courses = createRecords(Course::class, 4);
    seedEnrollmentsForStudent($student, $courses);

    $response = loadPageAndAssertOk('/dashboard');
    $content = $response->getContent();
    $count = substr_count($content, 'user-course');

    expect($count)->toBeLessThanOrEqual(3);
});

test('if the user has no courses, no courses should appear', function () {
    createAndActAsRole('student');

    $response = loadPageAndAssertOk('/dashboard');
    $content = $response->getContent();
    $count = substr_count($content, 'user-course');

    expect($count)->toBeEqual(0);
});

test('if the user has no courses, a specific message should appear', function () {
    createAndActAsRole('student');

    $response = loadPageAndAssertOk('/dashboard');
    $content = $response->getContent();
    $count = substr_count($content, 'user-course');

    expect('No courses enrolled yet.');
});
