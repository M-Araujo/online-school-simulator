<?php

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;


function createAndActAsRole(string $role): User {
    $user = User::factory()->create(['role' => $role]);
    test()->actingAs($user);
    return $user;
}

function createRecords(string $modelClass, int $count = 1, array $attributes = []): Collection|Model {
    return $modelClass::factory()->count($count)->create($attributes);
}

function createCoursesForTeacher(User $teacher, int $count, array $overrides = []): Collection {
    return Course::factory()->count($count)->create(array_merge([
        'teacher_id' => $teacher->id,
        'is_published' => true,
        'start_date' => now()->subWeek(),
        'end_date' => now()->addWeek(),
    ], $overrides));
}

function enrollStudentInCourses(User $student, iterable $courses): void {
    foreach ($courses as $course) {
        createRecords(Enrollment::class, 1, [
            'user_id' => $student->id,
            'course_id' => $course->id,
        ]);
    }
}

function assertCoursesVisible(TestResponse $response, iterable $courses): TestResponse {
    foreach ($courses as $course) {
        $response->assertSee($course->title);
        $response->assertSee(Str::limit($course->description, 100));
    }
    return $response;
}


function createUpcomingCourse(): Course {
    $teacher = User::factory()->create(['role' => 'teacher']);
    return Course::factory()->create([
        'teacher_id' => $teacher->id,
        'is_published' => true,
        'start_date' => now()->addDays(3),
        'end_date' => now()->addWeeks(1),
    ]);
}
