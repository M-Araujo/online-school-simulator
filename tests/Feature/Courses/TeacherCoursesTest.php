<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('loads the course data for teacher users', function () {
    createAndActAsTeacher();
    $this->get('/courses')->assertStatus(200);
});

test('guarantees the teacher cannot see the my courses page', function () {
    createAndActAsTeacher();
    $this->get('/my-courses')->assertRedirect('/dashboard');
});
