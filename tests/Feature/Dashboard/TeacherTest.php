<?php

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('dashboard shows teacher partial for teachers', function () {
    createAndActAsTeacher();
    $response = get('/dashboard');
    $response->assertSee('Your Courses');
});

test('teacher dashboard displays correct course stats', function () {

    $teacher = createAndActAsTeacher();

    // active courses
    createCoursesForTeacher($teacher, 2, [
        'start_date' => now()->subWeek(),
        'end_date' => now()->addWeek(),
    ]);

    // pending courses
    createCoursesForTeacher($teacher, 1, [
        'is_published' => false,
        'start_date' => now()->addDay(),
    ]);

    // passed and closed courses
    createCoursesForTeacher($teacher, 10, [
        'start_date' => now()->subMonths(3),
        'end_date' => now()->subMonths(2),
    ]);

    // upcomming courses
    createCoursesForTeacher($teacher, 4, [
        'start_date' => now()->addWeek(),
        'end_date' => now()->addWeeks(3)
    ]);

    $response = get('/dashboard');
    $response->assertSee('Your Courses')
        ->assertSee('Active: 2')
        ->assertSee('Pending: 1')
        ->assertSee('Completed: 10')
        ->assertSee('Upcoming: 4')
    ;
});