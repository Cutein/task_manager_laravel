<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $board->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Información del Tablero -->
                <h3 class="text-lg font-bold">{{ $board->name }}</h3>
                <p class="text-gray-600 mt-2">{{ $board->description ?? 'Sin descripción' }}</p>

                <!-- Botones de acción -->
                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('boards.edit', $board) }}" 
                       class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</a>

                    <form action="{{ route('boards.destroy', $board) }}" method="POST" 
                          onsubmit="return confirm('¿Seguro que deseas eliminar este tablero?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
                    </form>

                    <a href="{{ route('boards.index') }}" 
                       class="bg-blue-500 text-white px-4 py-2 rounded">Volver</a>
                </div>

                <!-- Lista de Tareas -->
                <div class="mt-6">
                    <h3 class="text-lg font-bold">Tareas</h3>

                    <!-- Botón para Crear Tarea -->
                    <a href="{{ route('boards.tasks.create', $board) }}" 
                       class="mt-2 inline-block bg-green-500 text-white px-4 py-2 rounded">
                        Crear Tarea
                    </a>

                    <ul class="mt-4">
                        @forelse ($board->tasks as $task)
                            <li class="border-b py-2 flex items-center">
                                <!-- Enlace al detalle de la tarea -->
                                <a href="{{ route('tasks.show', $task->id) }}" class="text-blue-500 font-medium flex-1">
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
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                        Eliminar
                                    </button>
                                </form>
                            </li>
                        @empty
                            <li class="text-gray-500">No hay tareas aún.</li>
                        @endforelse
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
