<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-page-title title="Course Details" class="mb-6" />

                <h2 class="text-4xl font-bold text-gray-900 dark:text-white tracking-tight">
                    {{ $item->title }}
                </h2>

                @if (!empty($item->description))
                    <div class="space-y-2">
                        <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300">Description</h3>
                        <p class="text-base text-gray-600 dark:text-gray-400 leading-relaxed">
                            {{ $item->description }}
                        </p>
                    </div>
                @endif

                <div class="pt-6 border-t border-gray-200 dark:border-gray-700 space-y-2">
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300">Schedule</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <strong class="text-gray-700 dark:text-gray-300">Starts:</strong>
                        {{ $item->start_date->format('F j, Y') }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <strong class="text-gray-700 dark:text-gray-300">Ends:</strong>
                        {{ $item->end_date->format('F j, Y') }}
                    </p>
                </div>

                @if (canUserApply($authenticatedUser, $item))
                    <form method="POST" action="{{ route('enrollments.store') }}"
                        class="pt-8 border-t border-gray-200 dark:border-gray-700">
                        @csrf
                        <input type="hidden" name="course_id" value={{ $item->id }}>
                        <button type="submit"
                            class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-6 py-3 rounded-xl shadow-lg transition-all duration-200">
                            Enroll Now
                        </button>
                    </form>
                @endif

                @can('viewLessons', $item)
                @if ($item->lessons)
                    <div>
                        Lessons:
                        @foreach ($item->lessons as $lesson)
                            <div>{{ $lesson->title }}</div>
                        @endforeach
                    </div>
                @endif
            @endcan
            </div>
        </div>
    </div>
</x-app-layout>
