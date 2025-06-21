<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


function createAndActAsAdmin()
{
    $admin = User::factory()->create(['role' => 'admin']);
    test()->actingAs($admin);
    return $admin;
}

function createAndActAsTeacher()
{
    $teacher = User::factory()->create(['role' => 'teacher']);
    test()->actingAs($teacher);
    return $teacher;
}

function createAndActAsStudent()
{
    $teacher = User::factory()->create(['role' => 'student']);
    test()->actingAs($teacher);
    return $teacher;
}

test('loads the users data', function () {
    createAndActAsAdmin();
    $users = User::factory()->count(3)->create();
    $response = $this->get('/users');
    foreach ($users as $user) {
        $response->assertSee($user->name);
    }
    $response->assertStatus(200);
});


test('users index return paginated results', function () {
    User::factory()->count(25)->create();
    createAndActAsAdmin();
    $this->get('/users')
        ->assertSee(User::find(1)->name)
        ->assertSee(User::find(10)->name)
        ->assertDontSee(User::find(16)->name)
        ->assertSee('Next');
});



test('teachers should not access users page', function () {
    createAndActAsTeacher();
    $response = $this->get('/users');
    $response->assertRedirect('/dashboard');
});

test('students should not access users page', function () {
    createAndActAsStudent();
    $response = $this->get('/users');
    $response->assertRedirect('/dashboard');
});

test('unauthorized users should not enter the users page', function () {
    $response = $this->get('/users');
    $response->assertRedirect('/login');
});