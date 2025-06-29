<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-page-title title="My Courses" class="mb-6" />

                @if ($items->count() > 0)
                    <x-card :authenticatedUser="$authenticatedUser" :items="$items" :headers="['Title', 'Description']" empty="No items found." :row="fn($item) => view('courses.partials.row', ['item' => $item])->render()" />
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
