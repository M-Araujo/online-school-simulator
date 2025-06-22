@props([
'items',
'empty' => 'No records found.',
'headers' => [],
'row'
])

<div class="overflow-hidden shadow-sm sm:rounded-lg p-6 bg-white dark:bg-gray-800">
    @if($items->isEmpty())
    <p class="text-gray-500 dark:text-gray-400">{{ $empty }}</p>
    @else
    <table class="table-auto w-full text-left text-sm text-gray-500 dark:text-gray-400">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                @foreach($headers as $header)
                <th class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            {!! $row($item) !!}
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $items->links() }}
    </div>
    @endif
</div>