<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// testing, add profile so users cant see 

test('loads the users data', function () {

    $user = User::factory()->create(['role' => 'admin']);
    $response = $this->actingAs($user);

    $users = User::factory()->count(3)->create();
    $response = $this->get('/users');
    foreach ($users as $user) {
        $response->assertSee($user->name);
    }
    $response->assertStatus(200);
});


test('users index return paginated results', function () {
    User::factory()->count(25)->create();

    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin);

    $response = $this->get('/users');
    $response->assertSee(User::find(1)->name);
    $response->assertSee(User::find(10)->name);
    $response->assertDontSee(User::find(16)->name);

    $response->assertSee('Next');
});