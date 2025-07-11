<?php

namespace Tests\Feature\Dashboard;

use App\Models\User;
use App\Models\Course;

use function Pest\Laravel\get;

test('dashboard shows admin partial for admin user', function () {
    createAndActAsRole('admin');
    $response = loadPageAndAssertOk('/dashboard');
    $response->assertSee('Users Overview');
});

test('admin sees the stats of the users overview', function () {
    createAndActAsRole('admin');
    User::factory()->count(4)->create(['role' => 'admin']);
    User::factory()->count(20)->create(['role' => 'teacher']);
    User::factory()->count(30)->create(['role' => 'student']);

    loadPageAndAssertOk('/dashboard')
        ->assertSee('Total Users: 55')
        ->assertSee('Students: 30')
        ->assertSee('Teachers: 20')
        ->assertSee('Admins: 5');
});

test('admin sees the stats of the course overview', function () {
    createAndActAsRole('admin');

    Course::factory()->count(10)->create([
        'is_published' => true,
        'start_date' => now()->subWeek(),
        'end_date' => now()->addWeek(),
    ]);

    Course::factory()->count(2)->create([
        'is_published' => false,
        'start_date' => now()->subWeek(),
        'end_date' => now()->addWeek(),
    ]);

    loadPageAndAssertOk('/dashboard')
        ->assertSee('Active Courses: 10')
        ->assertSee('Pending Approvals: 2');
});
