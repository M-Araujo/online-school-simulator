<x-app-layout>
    <x-slot name="header">
        <x-page-title title="Users"></x-page-title>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Users List</h3>

                @if($users->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">No users found.</p>
                @else
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($users as $user)
                    <li class="py-2 flex justify-between items-center">
                        <span class="text-gray-900 dark:text-gray-100">{{ $user->name }}</span>
                        <span class="text-gray-500 dark:text-gray-400 text-sm">{{ $user->email }}</span>
                    </li>
                    @endforeach
                </ul>
                {{ $users->links() }}
                @endif
            </div>

        </div>
    </div>
</x-app-layout>