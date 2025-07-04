<?php

use App\Models\User;

test('loads the users data', function () {
    createAndActAsRole('admin');
    $users = createRecords(User::class, 3);
    $response = $this->get('/users');
    foreach ($users as $user) {
        $response->assertSee($user->name);
    }
    $response->assertStatus(200);
});

test('users index return paginated results', function () {
    createRecords(User::class, 25);
    createAndActAsRole('admin');
    $this->get('/users')
        ->assertSee(User::find(1)->name)
        ->assertSee(User::find(10)->name)
        ->assertDontSee(User::find(16)->name)
        ->assertSee('Next');
});

test('teachers should not access users page', function () {
    createAndActAsRole('teacher');
    $this->get('/users')->assertRedirect('/dashboard');
});

test('students should not access users page', function () {
    createAndActAsRole('student');
    $this->get('/users')->assertRedirect('/dashboard');
});

test('unauthorized users should not enter the users page', function () {
    $this->get('/users')->assertRedirect('/login');
});
