<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;


abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        require_once base_path(env('TEST_HELPERS'));
    }
}
