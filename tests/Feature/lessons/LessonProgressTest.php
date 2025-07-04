<?php

namespace Tests\Feature\Lessons;

use App\Models\User;


test('an enrolled student should see a video on the course details page', function () {
    $student = createAndActAsRole('student');
    $teacher = User::factory()->create(['role' => 'teacher']);
    $course = createCoursesWithLessonsForTeacher($teacher, 1)->first();

    $response = enrollStudentAndAssert($this, $student, $course);
    $this->assertDatabaseHas('enrollments', [
        'user_id' => $student->id,
        'course_id' => $course->id,
    ]);

    $course->refresh();

    $response = $this->actingAs($student)
        ->get(route('courses.show', $course->slug))
        ->assertOk();

    $this->assertTrue($student->can('viewLessons', $course));
    $response->assertSee('<video', false);
});


// test to display wich videos is the current one
// validate the names list 
// create factory
// ...
