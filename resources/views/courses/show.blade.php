<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-page-title title="Course Details" class="mb-6" />
                
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white tracking-tight mb-6">
                    {{ $item->title }}
                </h2>

               
                    @if ($item->lessons && $item->lessons->isNotEmpty())
                        <div class="flex flex-col lg:flex-row gap-6 mb-8">
                            <div class="flex-1">
                                @can('viewLessons', $item)
                                <video id="current-lesson" class="w-full rounded-lg shadow-md" controls>
                                    <source src="{{ $item->lessons->first()->video_url }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>

                                @else 

                                <video id="current-lesson" class="w-full rounded-lg shadow-md" controls>
                                    <source src="{{ $currentLesson->video_url }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>

                                @endcan
                            </div>

                            <div class="w-full lg:w-1/3 bg-gray-100 dark:bg-gray-900 p-4 rounded-lg shadow-inner">
                                <h4 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Lessons</h4>
                                <ul class="space-y-2">
                                    @foreach ($item->lessons as $lesson)
                                        <li class="p-2 rounded hover:bg-blue-100 dark:hover:bg-blue-800 transition">
                                            {{ $lesson->title }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    
              

                @if (!empty($item->description))
                    <div class="space-y-2 mb-6">
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
                        <input type="hidden" name="course_id" value="{{ $item->id }}">
                        <button type="submit"
                            class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-6 py-3 rounded-xl shadow-lg transition-all duration-200">
                            Enroll Now
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
