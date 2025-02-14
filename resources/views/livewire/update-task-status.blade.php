<div>
    <select name="status" wire:model.live="status" class="w-40 px-3 py-1 border border-gray-300 rounded-md shadow-sm 
    focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-gray-700">
        @foreach (\App\Models\Task::getStatuses() as $value => $label)
            <option value="{{ $value }}" data-color="{{ \App\Models\Task::getStatusColor($value) }}">
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>