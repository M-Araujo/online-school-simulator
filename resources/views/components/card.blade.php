@props([
'items',
'empty' => 'No records found.',
'row'
])

<div class="overflow-hidden shadow-sm sm:rounded-lg p-6 bg-white dark:bg-gray-800">

    @if($items->isEmpty())
    <p class="text-gray-500 dark:text-gray-400">{{ $empty }}</p>
    @else

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($items as $item)
        <div class="course-card bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                    {{ $item->title }}
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                    {{ Str::limit($item->description, 100) }}
                </p>
            </div>

            <div class="mt-auto">
                <a class="inline-block bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded hover:bg-blue-700 transition">
                    Details
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $items->links() }}
    </div>
    @endif
</div>