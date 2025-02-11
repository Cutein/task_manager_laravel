<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $task->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Información de la tarea -->
                <h3 class="text-lg font-bold">{{ $task->title }}</h3>
                <p class="text-gray-600 mt-2">{{ $task->description ?? 'Sin descripción' }}</p>

                <!-- Fecha de Creación -->
                <p class="text-sm text-gray-500 mt-2">Creada el {{ $task->created_at->format('d/m/Y') }}</p>

                <!-- Estado de la Tarea -->
                <p class="mt-4"><strong>Estado:</strong> 
                    <span class="px-2 py-1 rounded 
                        {{ $task->status == 'completada' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                        {{ ucfirst($task->status) }}
                    </span>
                </p>

                <!-- Botones de Acción -->
                <div class="mt-6 flex space-x-2">
                    <a href="{{ route('tasks.edit', $task) }}" 
                       class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</a>

                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" 
                          onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
                    </form>
                    @if ($task->board)
                        <a href="{{ route('boards.show', $task->board) }}" 
                       class="bg-blue-500 text-white px-4 py-2 rounded">Volver al Tablero</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
