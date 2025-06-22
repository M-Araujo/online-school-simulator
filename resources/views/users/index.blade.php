<x-app-layout>
    <x-slot name="header">
        <x-page-title title="Users"></x-page-title>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Users List</h3>

                <x-listing
                    :items="$items"
                    :headers="['Title', 'Description']"
                    empty="No items found."
                    :row="fn($items) => view('users.partials.row', ['item' => $items])->render()" />
            </div>

        </div>
    </div>
</x-app-layout>