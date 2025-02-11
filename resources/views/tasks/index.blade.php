<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todas las Tareas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Lista de Tareas</h3>

                @if ($tasks->isEmpty())
                    <p class="text-gray-500">No hay tareas aún.</p>
                @else
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2 text-left">Título</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Tablero</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Fecha de vencimiento</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Etiquetas</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr class="border-b border-gray-200">
                                    <td class="px-4 py-2">
                                        <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-500 hover:underline">
                                            {{ $task->title }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $task->board->name ?? 'Sin tablero' }}
                                    </td>
                                    <td>
                                        <p>{{ $task->due_date ?$task->due_date->format('d/m/Y'): 'No definida' }}</p>
                                    </td>
                                    <td>
                                        <p>{{ implode(', ', $task->tags) }}</p>
                                    </td>
                                    <td class="px-4 py-2 text-right">
                                        <!-- Dropdown de estado -->
                                        <form action="{{ route('tasks.updateStatus', $task) }}" method="POST" class="inline-block ml-auto mr-4">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" 
                                                    class="w-40 px-3 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-gray-700">
                                                @foreach (\App\Models\Task::getStatuses() as $value => $label)
                                                    <option value="{{ $value }}" {{ $task->status === $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                        
                                        <a href="{{ route('tasks.edit', $task->id) }}" 
                                           class="mr-2 inline-block px-3 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                            Editar
                                        </a>
                                    
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-block px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400"
                                                    onclick="return confirm('¿Seguro que quieres eliminar esta tarea?');">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
