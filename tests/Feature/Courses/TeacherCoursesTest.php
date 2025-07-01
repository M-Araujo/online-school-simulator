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


test('if the current teacher has a course/lessons available the lessons should appear visible on the course details page', function () {

    $teacher = createAndActAsRole('teacher');
    $courses = createCoursesWithLessonsForTeacher($teacher, 1, [
        'start_date' => now()->subWeek(),
        'end_date' => now()->addWeeks(3),
    ]);

    $course = $courses->first();

    $this->get(route('courses.show', $course->slug))
        ->assertOk()
        ->assertSee('Lessons');
});

test('if other teacher consults course that are not his, available the lessons should not appear visible on the course details page', function () {

    $authorTeacher = createAndActAsRole('teacher');
    $courses = createCoursesWithLessonsForTeacher($authorTeacher, 1, [
        'start_date' => now()->subWeek(),
        'end_date' => now()->addWeeks(3),
    ]);

    $course = $courses->first();

    createAndActAsRole('teacher');

    $this->get(route('courses.show', $course->slug))
        ->assertOk()
        ->assertDontSee('Lessons');
});
