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

                <p><strong>Fecha de vencimiento:</strong> {{ $task->due_date ?$task->due_date->format('d/m/Y'): 'No definida' }}</p>
                <p><strong>Etiquetas:</strong> {{ ($task->tags!=null)?implode(', ', $task->tags):''; }}</p>

                <!-- Estado de la Tarea -->
                <p class="mt-4"><strong>Estado:</strong> 
                    <span class="px-2 py-1 rounded 
                        {{ $task->status == 'completada' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                        {{ ucfirst($task->status) }}
                    </span>
                </p>
                <div class="mt-3">
                    <p><strong>Asignado a:</strong> 
                        @forelse($task->users as $user)
                            <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded">{{ $user->name }}</span>
                        @empty
                            <span class="text-gray-500">No asignado</span>
                        @endforelse
                    </p>
                    
                </div>
                <!-- Lista de comentarios -->
                <h3 class="mt-4"><strong>Comentarios:</strong></h3>
                @foreach($task->comments as $comment)
                    <p><strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}</p>
                @endforeach

                <!-- Formulario para agregar un comentario -->
                <form action="{{ route('tasks.comments.store', $task) }}" method="POST">
                    @csrf
                    <textarea class="w-full" name="content" required></textarea>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" type="submit">Comentar</button>
                </form>

                <!-- Botones de Acción -->
                @if($task->board->user_id === auth()->id())
                <div class="mt-6 flex space-x-2">
                    <a href="{{ route('tasks.edit', $task) }}" 
                       class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</a>

                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" 
                          onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="this.disabled=true;this.form.submit();"  class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
                    </form>
                    @if ($task->board)
                        <a href="{{ route('boards.show', $task->board) }}" 
                       class="bg-blue-500 text-white px-4 py-2 rounded">Volver al Tablero</a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
