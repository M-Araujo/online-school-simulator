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

/*
// colocar o middelware nas páginas
test('teachers should not access this page', function () {
    $user = User::factory()->create(['role' => 'teacher']);
    $this->actingAs($user);
    $response = $this->get('/users');
    $response->assertForbidden();
});*/