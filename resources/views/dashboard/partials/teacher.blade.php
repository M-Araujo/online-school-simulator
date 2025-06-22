<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

    {{-- Courses Overview --}}
    <x-dashboard.card title="Your Courses">
        <p class="text-sm">Active: 3</p>
        <p class="text-sm">Pending: 1</p>
        <p class="text-sm">Completed: 2</p>
        <p class="text-sm">Upcoming: 1</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">
            Manage Courses
        </a>
    </x-dashboard.card>

    {{-- Student Engagement --}}
    <x-dashboard.card title="Student Activity">
        <p class="text-sm">Total Students: 86</p>
        <p class="text-sm">Assignments Pending Review: 5</p>
        <p class="text-sm">Discussions This Week: 12</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">
            View Student Insights
        </a>
    </x-dashboard.card>

    {{-- Upcoming Tasks --}}
    <x-dashboard.card title="Upcoming Tasks">
        <p class="text-sm">Grade Quiz: "Laravel Basics" (Due Today)</p>
        <p class="text-sm">Review Lesson: "Blade Components"</p>
        <p class="text-sm">Prepare Course: "Livewire Mastery" (Starts Next Week)</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">
            View All Tasks
        </a>
    </x-dashboard.card>

    {{-- Quick Actions --}}
    <x-dashboard.card title="Quick Actions">
        <ul class="text-sm list-disc list-inside">
            <li><a href="#" class="text-blue-500 hover:underline">Create New Course</a></li>
            <li><a href="#" class="text-blue-500 hover:underline">Upload New Lesson</a></li>
            <li><a href="#" class="text-blue-500 hover:underline">Enter Grades</a></li>
        </ul>
    </x-dashboard.card>

    {{-- Performance Overview --}}
    <x-dashboard.card title="Performance Overview">
        <p class="text-sm">Avg. Course Completion: 78%</p>
        <p class="text-sm">Avg. Quiz Score: 82%</p>
        <p class="text-sm">Feedback Rating: 4.6/5</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">
            View Analytics
        </a>
    </x-dashboard.card>

</div>