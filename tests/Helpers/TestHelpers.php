<?php

use App\Models\User;
use App\Models\Course;

function createAndActAsAdmin()
{
    $admin = User::factory()->create(['role' => 'admin']);
    test()->actingAs($admin);
    return $admin;
}

function createAndActAsTeacher()
{
    $teacher = User::factory()->create(['role' => 'teacher']);
    test()->actingAs($teacher);
    return $teacher;
}

function createAndActAsStudent()
{
    $teacher = User::factory()->create(['role' => 'student']);
    test()->actingAs($teacher);
    return $teacher;
}

function createRecords(string $modelClass, int $count = 1, array $attributes = [])
{
    return $modelClass::factory()->count($count)->create($attributes);
}

function createCoursesForTeacher(User $teacher, int $count, array $overrides = [])
{
    Course::factory()->count(2)->create([
        'teacher_id' => $teacher->id,
        'is_published' => true,
        'start_date' => now()->subWeek(),
        'end_date' => now()->addWeek(),
    ]);
}
