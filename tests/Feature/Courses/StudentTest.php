<?php

use App\Models\Course;


test('students should be able to see the enroll button', function () {

    createRecords(Course::class, 3);
    createAndActAsStudent();

    $response = $this->get('/courses')->assertStatus(200);
    $response->assertSee('Details', escape: false);
});

test('student sees the correct link to course details', function () {

    createAndActAsStudent();

    $course = createRecords(Course::class, 1);
    $detailsUrl = route('courses.show', $course->first()->slug);

    $this->get('/courses')
        ->assertStatus(200)
        ->assertSee('href="' . $detailsUrl . '"', escape: false);
});

test('student access the course details page', function () {

    createAndActAsStudent();

    $course = createRecords(Course::class, 1);

    $this->get(route('courses.show', $course->first()->slug))->assertSee($course->first()->title);
});

// todo ver se os outros perfis vem isto ou não 
