<?php

use App\Models\Course;


test('students should be able to see the enroll button', function () {
    createAndActAsStudent();

    createRecords(Course::class, 3);
    $response = $this->get('/courses')->assertStatus(200);
    $response->assertSee('Details', escape: false);
});


// todo ver se os outros perfis vem isto ou não 
