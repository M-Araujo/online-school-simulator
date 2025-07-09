<x-app-layout>
    <div class="py-12">
     
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-page-title title="Welcome, {{ $authenticatedUser->name }}!" class="mb-6" />

                <div>   
                    @include("dashboard.partials.$authenticatedUser->role" )
                </div>
            </div>
        </div>
    </div>
</x-app-layout>