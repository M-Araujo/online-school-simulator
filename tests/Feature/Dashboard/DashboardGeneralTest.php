<?php

namespace Tests\Feature\Dashboard;

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('dashboard is accessible for authenticated user', function () {
    $user = User::factory()->create(['role' => 'student']);
    $response = actingAs($user)->get('/dashboard');
    $response->assertStatus(200);
});

test('dashboard redirects for unauthenticated user', function () {
    $response = get('/dashboard');
    $response->assertRedirect('/login');
});

test('dashboard displays user name', function () {
    $user = User::factory()->create(['name' => 'John Doe', 'role' => 'student']);
    $response = actingAs($user)->get('/dashboard');
    $response->assertSee('Welcome, John Doe!');
});
