<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-page-title title="My Courses" class="mb-6" />

                @if($items->count() > 0)
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($items as $item)
                            <x-widget-card title="{{ $item->title }}">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ Str::limit($item->description, 100) }}
                                </p>

                                <div class="mt-4">
                                    <a href="{{ route('courses.show', $item->id) }}"
                                       class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                                        View Course →
                                    </a>
                                </div>
                            </x-widget-card>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-600 dark:text-gray-400 text-lg">
                            You’re not enrolled in any courses yet.
                        </p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
