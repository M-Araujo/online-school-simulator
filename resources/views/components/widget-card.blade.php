@props(['title'])
<div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md max-w-md w-full">
    <h3 class="font-semibold text-lg mb-3">{{ $title }}</h3>
    <div class="text-sm text-gray-700 dark:text-gray-300">
        {{ $slot }}
    </div>
</div>