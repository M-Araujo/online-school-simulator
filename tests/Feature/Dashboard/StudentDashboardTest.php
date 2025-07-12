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


test('the user last 3 courses should appear', function () {
    $student = createAndActAsRole('student');

    $courses = createRecords(Course::class, 4);
    seedEnrollmentsForStudent($student, $courses);

    $response = loadPageAndAssertOk('/dashboard');
    $courseCards = $response->dom()->filter('.user-course');

    expect($courseCards->count())->toBeLessThanOrEqual(3);
});




// shows users latest 3 course
// message if user has no courses
// 