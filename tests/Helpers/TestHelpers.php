<?php

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

function createAndActAsAdmin(): User {
    $admin = User::factory()->create(['role' => 'admin']);
    test()->actingAs($admin);
    return $admin;
}

function createAndActAsTeacher(): User {
    $teacher = User::factory()->create(['role' => 'teacher']);
    test()->actingAs($teacher);
    return $teacher;
}

function createAndActAsStudent(): User {
    $student = User::factory()->create(['role' => 'student']);
    test()->actingAs($student);
    return $student;
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
