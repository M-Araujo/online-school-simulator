<?php

test('loads the course data for teacher users', function () {
    createAndActAsRole('teacher');
    $this->get('/courses')->assertStatus(200);
});

test('guarantees the teacher cannot see the my courses page', function () {
    createAndActAsRole('teacher');
    $this->get('/student-courses')->assertRedirect('/dashboard');
});



test('if a teacher enters the courses list button displays "Details" always', function () {

    createAndActAsRole('teacher');
    $course = createUpcomingCourse();

    $this->get('/courses')
        ->assertSee($course->title)
        ->assertSee('Details');
});

test('if a teacher enters the courses list button should never display "Continue learning"', function () {

    createAndActAsRole('teacher');
    $course = createUpcomingCourse();

    $this->get('/courses')
        ->assertSee($course->title)
        ->assertDontSee('Continue learning');
});
