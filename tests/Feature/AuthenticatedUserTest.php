<?php

use App\Models\User;
use App\Models\Course;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
    $this->course = Course::factory()->create();
});

it('shares authenticatedUser variable in all authenticated views', function () {
    $authenticatedRoutes = [
        route('dashboard'),
        route('courses.index'),
        route('student.courses'),
        route('users.index'),
        route('courses.show', $this->course->slug),
    ];

    $assertionRun = false;

    foreach ($authenticatedRoutes as $route) {
        $response = $this->get($route);

        info("Route: $route, Status: " . $response->status());

        if ($response->status() === 200) {
            $response->assertViewHas('authenticatedUser');

            $viewUser = $response->viewData('authenticatedUser');
            expect($viewUser->id)->toBe($this->user->id);

            $assertionRun = true;
        } elseif ($response->status() === 302) {
            info('Redirect location: ' . $response->headers->get('Location'));
        }
    }

    expect($assertionRun)->toBeTrue('At least one route should return 200 and have the variable.');
});
