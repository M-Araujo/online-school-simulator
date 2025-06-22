<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

    <x-dashboard.card title="Users Overview">
        <p class="text-sm text-gray-700 dark:text-gray-300">Total Users: {{$dashboardStats['total_users']}}</p>
        <p class="text-sm text-gray-700 dark:text-gray-300">Students: {{$dashboardStats['students_count']}}</p>
        <p class="text-sm text-gray-700 dark:text-gray-300">Teachers: {{$dashboardStats['teachers_count']}}</p>
        <p class="text-sm text-gray-700 dark:text-gray-300">Admins: {{$dashboardStats['admins_count']}}</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">Manage Users</a>
    </x-dashboard.card>

    <x-dashboard.card title="Courses">
        <p class="text-sm text-gray-700 dark:text-gray-300">Active Courses: {{$dashboardStats['active_courses']}}</p>
        <p class="text-sm text-gray-700 dark:text-gray-300">Pending Approvals: {{$dashboardStats['pending_approvals']}}</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">Manage Courses</a>
    </x-dashboard.card>

    <x-dashboard.card title="Platform Analytics">
        <p class="text-sm text-gray-700 dark:text-gray-300">Active Students Today: 100</p>
        <p class="text-sm text-gray-700 dark:text-gray-300">Quizzes Taken: 300</p>
        <p class="text-sm text-gray-700 dark:text-gray-300">Avg. Course Completion: 75%</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">View Reports</a>
    </x-dashboard.card>
</div>