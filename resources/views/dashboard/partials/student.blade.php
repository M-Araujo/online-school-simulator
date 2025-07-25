<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">


    <x-widget-card title="Current Courses">
        @if(count($dashboardStats['userCourses']) > 0)
            @foreach($dashboardStats['userCourses'] as $course)
                <p class="user-course">{{$course->title}} — <span class="text-green-600">60% complete</span></p>
            @endforeach
        @else 
            <p>No courses enrolled yet.</p>
        @endif
        <a href="/student-courses" class="text-blue-500 hover:underline mt-2 inline-block">View All Courses</a>
    </x-widget-card>

    <x-widget-card title="Upcoming Quizzes">
        <p><strong>Laravel Routing Quiz</strong> — Due <span class="text-red-500">Today</span></p>
        <p><strong>Vue Components</strong> — Due in 3 days</p>
        <p><strong>Tailwind Utilities Test</strong> — Due in 5 days</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block">Go to Quizzes</a>
    </x-widget-card>

    <x-widget-card title="Achievements">
        <ul class="list-disc list-inside text-sm text-gray-700 dark:text-gray-300">
            <li>🏅 Completed "Intro to Laravel"</li>
            <li>🔥 7-Day Learning Streak</li>
            <li>💡 Top Score on "Blade Components" quiz</li>
        </ul>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block">View All Badges</a>
    </x-widget-card>

    <x-widget-card title="Recent Activity">
        <p>✅ Submitted: Blade Template Quiz</p>
        <p>📘 Completed: Vue.js — Data Binding Lesson</p>
        <p>💬 Commented on: “Eloquent Tips” forum thread</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block">View Full Activity</a>
    </x-widget-card>

</div>
