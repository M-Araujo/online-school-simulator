<?php

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('dashboard shows admin partial for admin user', function () {
    createAndActAsAdmin();
    $response = get('/dashboard');
    $response->assertSee('Users Overview');
});

test('admin sees the stats of the users overview', function () {
    createAndActAsAdmin();
    User::factory()->count(4)->create(['role' => 'admin']);
    User::factory()->count(20)->create(['role' => 'teacher']);
    User::factory()->count(30)->create(['role' => 'student']);

    get('/dashboard')
        ->assertSee('Total Users: 55')
        ->assertSee('Students: 30')
        ->assertSee('Teachers: 20')
        ->assertSee('Admins: 5');
});

test('admin sees the stats of the course overview', function () {
    createAndActAsAdmin();

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

    get('/dashboard')
        ->assertSee('Active Courses: 10')
        ->assertSee('Pending Approvals: 2');
});
