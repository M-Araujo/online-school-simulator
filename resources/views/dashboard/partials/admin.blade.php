<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

    <x-widget-card title="Users Overview">
        <p class="text-sm text-gray-700 dark:text-gray-300">Total Users: {{$dashboardStats['totalUsers']}}</p>
        <p class="text-sm text-gray-700 dark:text-gray-300">Students: {{$dashboardStats['studentsCount']}}</p>
        <p class="text-sm text-gray-700 dark:text-gray-300">Teachers: {{$dashboardStats['teachersCount']}}</p>
        <p class="text-sm text-gray-700 dark:text-gray-300">Admins: {{$dashboardStats['adminsCount']}}</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">Manage Users</a>
    </x-widget-card>

    <x-widget-card title="Courses">
        <p class="text-sm text-gray-700 dark:text-gray-300">Active Courses: {{$dashboardStats['activeCourses']}}</p>
        <p class="text-sm text-gray-700 dark:text-gray-300">Pending Approvals: {{$dashboardStats['pendingApprovals']}}</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">Manage Courses</a>
    </x-widget-card>

    <x-widget-card title="Platform Analytics">
        <p class="text-sm text-gray-700 dark:text-gray-300">Active Students Today: 100</p>
        <p class="text-sm text-gray-700 dark:text-gray-300">Quizzes Taken: 300</p>
        <p class="text-sm text-gray-700 dark:text-gray-300">Avg. Course Completion: 75%</p>
        <a href="#" class="text-blue-500 hover:underline mt-2 inline-block text-sm">View Reports</a>
    </x-widget-card>
</div>