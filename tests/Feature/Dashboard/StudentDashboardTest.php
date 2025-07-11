<?php

namespace Tests\Feature\Dashboard;

use function Pest\Laravel\get;

test('dashboard shows studentpartial for students', function () {
    createAndActAsRole('student');
    get('/dashboard')->assertSee('Current Courses');
});
