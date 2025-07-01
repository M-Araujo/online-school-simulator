<?php

use App\Models\User;
use App\Models\Lesson;
use App\Models\Course;

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

    // Re-authenticate for the final request
    $this->actingAs($student);

    $response = $this->get(route('courses.show', $course->slug));
    $response->assertDontSee('Enroll Now');
});


test('enroll should return an error if the student is already enrolled on that course', function () {
    $student = createAndActAsRole('student');
    $course = createUpcomingCourse();

    $this->get(route('courses.show', $course->slug))
        ->assertSee($course->title)
        ->assertSee('Enroll Now');

    // First enrollment attempt - should succeed
    $response = $this->post(route('enrollments.store'), ['course_id' => $course->id]);
    $response->assertRedirect(route('courses.show', $course->slug));

    $this->assertDatabaseHas('enrollments', [
        'user_id' => $student->id,
        'course_id' => $course->id,
    ]);

    // Second enrollment attempt - should fail with error
    $response = $this->post(route('enrollments.store'), ['course_id' => $course->id]);
    $response->assertRedirect(route('courses.show', $course->slug));
    $response->assertSessionHasErrors([
        'course_id' => 'You are already enrolled in this course.'
    ]);

    // Follow the redirect and verify error message is visible on the page
    $followUpResponse = $this->get(route('courses.show', $course->slug));
    $followUpResponse->assertSee('You are already enrolled in this course.');
});


test('a student with no enrollments sees a friendly message', function () {
    $student = createAndActAsRole('student');

    $this->assertCount(0, $student->enrolledCourses);

    $response = $this->get('/student-courses');

    $response->assertOk()
        ->assertSee('You’re not enrolled in any courses yet.');
});


test('if a student has not enrolled on the course, list button displays "Details"', function () {

    createAndActAsRole('student');
    $course = createUpcomingCourse();

    $this->get('/courses')
        ->assertSee($course->title)
        ->assertSee('Details');
});

test('if a student and has enrolled on the course, list button displays Continue learning', function () {

    $student = createAndActAsRole('student');
    $course = createUpcomingCourse();

    $this->get(route('courses.show', $course->slug))
        ->assertOk()
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

    $this->get('/courses')
        ->assertSee($course->title)
        ->assertSee('Continue learning');
});



test('an enrolled student can see lessons on the course details page', function () {
    $student = User::factory()->create(['role' => 'student']);
    $this->actingAs($student);

    $teacher = User::factory()->create(['role' => 'teacher']);
    $course = Course::factory()->create(['teacher_id' => $teacher->id]);
    $lessons = Lesson::factory()->count(3)->create(['course_id' => $course->id]);

    $response = $this->withHeaders(['X-CSRF-TOKEN' => csrf_token()])
        ->post(route('enrollments.store'), [
            'course_id' => $course->id,
        ]);

    $response->assertRedirect(route('courses.show', $course->slug));
    $response->assertSessionHas('success', 'Enrollment successful!');

    $this->assertDatabaseHas('enrollments', [
        'user_id' => $student->id,
        'course_id' => $course->id,
    ]);

    $course->refresh();

    $response = $this->actingAs($student)
        ->get(route('courses.show', $course->slug))
        ->assertOk();

    $canView = $student->can('viewLessons', $course);

    $response->assertSee('Lessons');
});
