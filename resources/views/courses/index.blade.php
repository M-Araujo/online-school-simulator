<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-page-title title="Course List" class="mb-6" />
                <x-card
                    :items="$items"
                    :headers="['Title', 'Description']"
                    empty="No items found."
                    :row="fn($item) => view('courses.partials.row', ['item' => $item])->render()" />
            </div>
        </div>
    </div>
</x-app-layout>