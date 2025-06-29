<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// Apply base TestCase to all Feature and Unit tests
uses(TestCase::class)->in('Feature', 'Unit');

// Automatically refresh the database in all tests
uses(RefreshDatabase::class)->in('Feature', 'Unit');


expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

// Optional global helper functions
function something() {
    // ...
}
