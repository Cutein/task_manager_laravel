<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <!-- Información del Tablero -->
                <div class="mb-6">
                    <h3 class="text-lg font-bold flex items-center">
                        <x-heroicon-o-presentation-chart-bar class="w-6 h-6 text-gray-700 mr-2" />
                        {{ $board->name }}
                    </h3>
                    <p class="text-gray-600 mt-1">{{ $board->description ?? 'Sin descripción' }}</p>
                </div>

                <!-- Botones de acción -->
                <div class="flex space-x-3 mb-6">
                    <a href="{{ route('boards.edit', $board) }}" 
                       class="flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded transition">
                        <x-heroicon-o-pencil-square class="w-5 h-5 mr-1" /> Editar
                    </a>

                    <form action="{{ route('boards.destroy', $board) }}" method="POST" 
                          onsubmit="return confirm('¿Seguro que deseas eliminar este tablero?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="flex items-center bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition">
                            <x-heroicon-o-trash class="w-5 h-5 mr-1" /> Eliminar
                        </button>
                    </form>

                    <a href="{{ route('boards.index') }}" 
                       class="flex items-center bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
                        <x-heroicon-o-arrow-left class="w-5 h-5 mr-1" /> Volver
                    </a>
                </div>

                <!-- Lista de Tareas -->
                <div class="mt-6">
                    <h3 class="text-lg font-bold flex items-center">
                        <x-heroicon-o-list-bullet class="w-6 h-6 text-gray-700 mr-2" />
                        Tareas
                    </h3>

                    <!-- Botón para Crear Tarea -->
                    <a href="{{ route('boards.tasks.create', $board) }}" 
                       class="mt-2 inline-flex items-center bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
                        <x-heroicon-o-plus class="w-5 h-5 mr-1" /> Crear Tarea
                    </a>

                    <ul class="mt-4">
                        @forelse ($board->tasks as $task)
                            <li class="border-b py-3 flex items-center">
                                
                                <!-- Enlace al detalle de la tarea -->
                                <a href="{{ route('tasks.show', $task->id) }}" 
                                   class="text-blue-500 hover:text-blue-700 font-medium flex-1">
                                    <x-heroicon-o-document-text class="w-5 h-5 text-gray-600 mr-2 inline-block" />
                                    {{ $task->title }}
                                </a>

                                <!-- Dropdown de estado -->
                                <form action="{{ route('tasks.updateStatus', $task) }}" method="POST" class="ml-auto mr-4">
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

                                <!-- Botón de eliminar -->
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition flex items-center">
                                        <x-heroicon-o-trash class="w-5 h-5 mr-1" /> Eliminar
                                    </button>
                                </form>
                            </li>
                        @empty
                            <li class="text-gray-500 mt-2">No hay tareas aún.</li>
                        @endforelse
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
