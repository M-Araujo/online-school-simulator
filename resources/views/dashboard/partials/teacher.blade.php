<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

    <x-dashboard.card title="Your Progress">
        <p class="text-sm">Courses Enrolled: 3</p>
        <p class="text-sm">Lessons Completed: 18</p>
        <p class="text-sm">Quizzes Passed: 5</p>
        <p class="text-sm">Avg. Score: 87%</p>
    </x-dashboard.card>

    <x-dashboard.card title="Continue Learning">
        <p class="text-sm">Next Lesson: Laravel Basics - “Blade Templates”</p>
        <p class="text-sm">Due: June 15</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">Resume Course</a>
    </x-dashboard.card>

    <x-dashboard.card title="Upcoming Quizzes">
        <p class="text-sm">Quiz: "Blade Components" – Due in 2 days</p>
        <p class="text-sm">Quiz: "Laravel Routing" – Not started</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">View All Quizzes</a>
    </x-dashboard.card>

    <x-dashboard.card title="Activity Log">
        <ul class="text-sm list-disc list-inside">
            <li>Completed: "Lesson 5 – Blade Basics"</li>
            <li>Passed Quiz: "Laravel Controllers"</li>
            <li>Earned: “Intermediate Learner” Badge</li>
        </ul>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">View Full History</a>
    </x-dashboard.card>
</div>