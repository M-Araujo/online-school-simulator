<?php

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('students should be able to see the enroll button', function () {
    createRecords(Course::class, 3);
    createAndActAsRole('student');

    $response = $this->get('/courses')->assertStatus(200);
    $response->assertSee('Details', escape: false);
});

test('student sees the correct link to course details', function () {
    createAndActAsRole('student');

    $course = createRecords(Course::class, 1);
    $detailsUrl = route('courses.show', $course->first()->slug);

    $this->get('/courses')
        ->assertStatus(200)
        ->assertSee('href="' . $detailsUrl . '"', escape: false);
});

test('student access the course details page', function () {
    createAndActAsRole('student');

    $course = createRecords(Course::class, 1);

    $this->get(route('courses.show', $course->first()->slug))->assertSee($course->first()->title);
});

test('student sees their enrolled courses list', function () {
    $student = createAndActAsRole('student');
    $courses = createRecords(Course::class, 4);

    enrollStudentInCourses($student, $courses);

    $response = $this->get('/student-courses')
        ->assertStatus(200)
        ->assertSee('My Courses');

    assertCoursesVisible($response, $courses);
});

test('loads the course data for students users', function () {
    createAndActAsRole('student');

    $this->get('/courses')->assertStatus(200);
});


test('student enrols a course', function () {
    $student = createAndActAsRole('student');
    $course = createUpcomingCourse();

    $this->get('/courses')->assertStatus(200);

    $this->get(route('courses.show', $course->slug))
        ->assertSee($course->title)
        ->assertSee('Enroll Now');

    $response = $this->post(route('enrollments.store'), [
        'course_id' => $course->id,
    ]);

    $response->assertRedirect(route('courses.show', $course->slug));
    $response->assertSessionHas('success', 'Enrollment successful!');

    $this->assertDatabaseHas('enrollments', [
        'user_id' => $student->id,
        'course_id' => $course->id,
    ]);
});

test('enroll button should disappear after the student’s enrollment', function () {
    $student = createAndActAsRole('student');
    $course = createUpcomingCourse();

    $this->get('/courses')->assertStatus(200);

    $this->get(route('courses.show', $course->slug))
        ->assertSee($course->title)
        ->assertSee('Enroll Now');

    $this->post(route('enrollments.store'), [
        'course_id' => $course->id,
    ])->assertRedirect(route('courses.show', $course->slug));

    $this->assertDatabaseHas('enrollments', [
        'user_id' => $student->id,
        'course_id' => $course->id,
    ]);

    // 🔑 Re-authenticate for the final request
    $this->actingAs($student);

    $response = $this->get(route('courses.show', $course->slug));
    $response->assertDontSee('Enroll Now');
});


test('enroll should return an error if the student is already enrolled on that course', function () {
    $student = createAndActAsRole('student');
    $course = createUpcomingCourse();

    $this->get('/courses')->assertStatus(200);

    $this->get(route('courses.show', $course->slug))
        ->assertSee($course->title)
        ->assertSee('Enroll Now');

    // First enrollment attempt
    $response = $this->post(route('enrollments.store'), [
        'course_id' => $course->id,
    ]);
    $response->assertRedirect(route('courses.show', $course->slug));

    $this->assertDatabaseHas('enrollments', [
        'user_id' => $student->id,
        'course_id' => $course->id,
    ]);

    // Second enrollment attempt (should fail)
    $response = $this->post(route('enrollments.store'), [
        'course_id' => $course->id,
    ]);
    $response->assertRedirect(route('courses.show', $course->slug));

    // Check for error message in session
    $response->assertSessionHas('error', 'Current user is already enrolled on this course.');

    // Optionally, follow the redirect and check if error message is displayed on page
    $followUpResponse = $this->get(route('courses.show', $course->slug));
    $followUpResponse->assertSee('Error: current user is already enrolled on this course.');
});

// todo add test when no courses exist
