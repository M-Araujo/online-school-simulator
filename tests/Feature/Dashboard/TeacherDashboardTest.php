<?php

namespace Tests\Feature\Dashboard;

use function Pest\Laravel\get;

test('dashboard shows teacher partial for teachers', function () {
    createAndActAsRole('teacher');
    $response = loadPageAndAssertOk('/dashboard');
    $response->assertSee('Your Courses');
});

test('teacher dashboard displays correct course stats', function () {

    $teacher = createAndActAsRole('teacher');

    // active courses
    createCoursesWithLessonsForTeacher($teacher, 2, [
        'start_date' => now()->subWeek(),
        'end_date' => now()->addWeek(),
    ]);

    // pending courses
    createCoursesWithLessonsForTeacher($teacher, 1, [
        'is_published' => false,
        'start_date' => now()->addDay(),
    ]);

    // passed and closed courses
    createCoursesWithLessonsForTeacher($teacher, 10, [
        'start_date' => now()->subMonths(3),
        'end_date' => now()->subMonths(2),
    ]);

    // upcomming courses
    createCoursesWithLessonsForTeacher($teacher, 4, [
        'start_date' => now()->addWeek(),
        'end_date' => now()->addWeeks(3)
    ]);

    $response = loadPageAndAssertOk('/dashboard');
    $response->assertSee('Your Courses')
        ->assertSee('Active: 2')
        ->assertSee('Pending: 1')
        ->assertSee('Completed: 10')
        ->assertSee('Upcoming: 4')
    ;
});
