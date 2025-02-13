<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 flex items-center">
                    <x-heroicon-o-clipboard-document-list class="w-6 h-6 text-gray-700 mr-2" />
                    Lista de Tareas
                </h3>

                @if ($tasks->isEmpty())
                    <p class="text-gray-500">No hay tareas aún.</p>
                @else
                    <table class="w-full border-collapse border border-gray-200 rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="border border-gray-300 px-4 py-2 text-left">Título</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Tablero</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Fecha de vencimiento</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Etiquetas</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 flex items-center">
                                        <x-heroicon-o-document-text class="w-5 h-5 text-gray-500 mr-2" />
                                        <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-500 hover:underline">
                                            {{ $task->title }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $task->board->name ?? 'Sin tablero' }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $task->due_date ? $task->due_date->format('d/m/Y') : 'No definida' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-sm text-gray-700 bg-gray-200 px-2 py-1 rounded">
                                            {{ implode(', ', $task->tags) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right flex justify-end space-x-2">
                                        <!-- Dropdown de estado -->
                                        <form action="{{ route('tasks.updateStatus', $task) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" 
                                                    class="w-36 px-3 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-gray-700">
                                                @foreach (\App\Models\Task::getStatuses() as $value => $label)
                                                    <option value="{{ $value }}" {{ $task->status === $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>

                                        <!-- Botón Editar -->
                                        <a href="{{ route('tasks.edit', $task->id) }}" 
                                           class="flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded transition">
                                            <x-heroicon-o-pencil-square class="w-5 h-5 mr-1" />
                                            Editar
                                        </a>
                                    
                                        <!-- Botón Eliminar -->
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="flex items-center bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded transition"
                                                    onclick="return confirm('¿Seguro que quieres eliminar esta tarea?');">
                                                <x-heroicon-o-trash class="w-5 h-5 mr-1" />
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
