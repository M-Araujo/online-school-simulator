<?php

use App\Models\User;

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