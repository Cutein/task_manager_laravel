<div>
    <select name="status" wire:model.live="status" class="mr-2 w-40 px-3 py-1 border border-gray-300 rounded-md shadow-sm 
    focus:outline-none bg-white text-gray-700">
        @foreach (\App\Models\Task::getStatuses() as $value => $label)
            <option value="{{ $value }}" data-color="{{ \App\Models\Task::getStatusColor($value) }}" data-tx-color="{{ \App\Models\Task::getStatusTxColor($value) }}">
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>