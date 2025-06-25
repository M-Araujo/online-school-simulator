<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('unauthenticated users are redirected to login when entering the url', function () {
    $this->get('/courses')->assertRedirect('/login');
});
