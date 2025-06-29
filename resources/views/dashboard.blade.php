<x-app-layout>
    <div class="py-12">
     
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-page-title title="Welcome, {{ auth()->user()->name }}!" class="mb-6" />

                <div>
                    @if(auth()->user()->isAdmin())
                    @include('dashboard.partials.admin')

                    @elseif(auth()->user()->isTeacher())
                    @include('dashboard.partials.teacher')

                    @else
                    @include('dashboard.partials.student')
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>