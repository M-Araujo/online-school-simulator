<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-3xl font-semibold text-gray-900 dark:text-gray-100 mb-6">
                    Welcome, {{ auth()->user()->name }}!
                </h1>

                <div class="py-12">
                    @if(auth()->user()->role === 'admin')
                    @include('dashboard.partials.admin')

                    @elseif(auth()->user()->role === 'teacher')
                    @include('dashboard.partials.teacher')

                    @else
                    @include('dashboard.partials.student')
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>