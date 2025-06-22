<x-app-layout>
    <x-slot name="header">
        <x-page-title title="Courses"></x-page-title>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Courses List</h3>

                @if($courses->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">No course found.</p>
                @else
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($courses as $course)
                    <li class="py-2 flex justify-between items-center">
                        <span class="text-gray-900 dark:text-gray-100">{{ $course->title }}</span>
                        <span class="text-gray-500 dark:text-gray-400 text-sm">{{ $course->description }}</span>
                    </li>
                    @endforeach
                </ul>
                {{ $courses->links() }}
                @endif
            </div>

        </div>
    </div>
</x-app-layout>