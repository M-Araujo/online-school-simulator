<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

    <x-widget-card title="Your Courses">
        <p class="text-sm">Active: {{$dashboardStats['activeCourses']}}</p>
        <p class="text-sm">Pending: {{$dashboardStats['pendingCourses']}}</p>
        <p class="text-sm">Completed: {{$dashboardStats['completedCourses']}}</p>
        <p class="text-sm">Upcoming: {{$dashboardStats['upcomingCourses']}}</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">
            Manage Courses
        </a>
    </x-widget-card>

    {{-- Student Engagement --}}
    <x-widget-card title="Student Activity">
        <p class="text-sm">Students Across All Courses: 86</p>
        <p class="text-sm">Assignments Pending Review: 5</p>
        <p class="text-sm">Discussions This Week: 12</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">
            View Student Insights
        </a>
    </x-widget-card>

    {{-- Upcoming Tasks --}}
    <x-widget-card title="Upcoming Tasks">
        <p class="text-sm">Grade Quiz: "Laravel Basics" (Due Today)</p>
        <p class="text-sm">Review Lesson: "Blade Components"</p>
        <p class="text-sm">Prepare Course: "Livewire Mastery" (Starts Next Week)</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">
            View All Tasks
        </a>
    </x-widget-card>

    {{-- Quick Actions --}}
    <x-widget-card title="Quick Actions">
        <ul class="text-sm list-disc list-inside">
            <li><a href="#" class="text-blue-500 hover:underline">Create New Course</a></li>
            <li><a href="#" class="text-blue-500 hover:underline">Upload New Lesson</a></li>
            <li><a href="#" class="text-blue-500 hover:underline">Enter Grades</a></li>
        </ul>
    </x-widget-card>

    {{-- Performance Overview --}}
    <x-widget-card title="Performance Overview">
        <p class="text-sm">Avg. Course Completion: 78%</p>
        <p class="text-sm">Avg. Quiz Score: 82%</p>
        <p class="text-sm">Feedback Rating: 4.6/5</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">
            View Analytics
        </a>
    </x-widget-card>

</div>