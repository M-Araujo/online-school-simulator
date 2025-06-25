<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('loads the course data for teacher users', function () {
    createAndActAsTeacher();
    $this->get('/courses')->assertStatus(200);
});
