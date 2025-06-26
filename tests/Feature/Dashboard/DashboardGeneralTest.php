<?php

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('dashboard is accessible for authenticated user', function () {
    $user = User::factory()->create();
    $response = actingAs($user)->get('/dashboard');
    $response->assertStatus(200);
});

test('dashboard redirects for unauthenticated user', function () {
    $response = get('/dashboard');
    $response->assertRedirect('/login');
});

test('dashboard displays user name', function () {
    $user = User::factory()->create(['name' => 'John Doe']);
    $response = actingAs($user)->get('/dashboard');
    $response->assertSee('Welcome, John Doe!');
});
