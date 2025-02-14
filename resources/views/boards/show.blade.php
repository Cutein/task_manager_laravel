<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <!-- Información del Tablero -->
                <div class="mb-6">
                    <h3 class="text-lg font-bold flex items-center">
                        @if($board->user_id === auth()->id())
                            <x-heroicon-o-presentation-chart-bar class="w-6 h-6 text-blue-700 mr-2" /> 
                        @else
                            <x-heroicon-o-presentation-chart-bar class="w-6 h-6 text-green-700 mr-2" />
                        @endif
                        {{ $board->name }}
                    </h3>
                    <p class="text-gray-600 mt-1">{{ $board->description ?? 'Sin descripción' }}</p>
                </div>

                <div class="flex space-x-3 mb-6">
                    @if($board->user_id === auth()->id())
                        <a href="{{ route('boards.edit', $board) }}" 
                            class="flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded transition">
                            <x-heroicon-o-pencil-square class="w-5 h-5 mr-1" /> Editar
                        </a>

                        <form action="{{ route('boards.destroy', $board) }}" method="POST" 
                            onsubmit="return confirm('¿Seguro que deseas eliminar este tablero?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="this.disabled=true;this.form.submit();" 
                                    class="flex items-center bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition">
                                <x-heroicon-o-trash class="w-5 h-5 mr-1" /> Eliminar
                            </button>
                        </form>
                    @endif
                </div>

                <!-- Lista de Tareas -->
                <div class="mt-6">
                    <h3 class="text-lg font-bold flex items-center">
                        <x-heroicon-o-list-bullet class="w-6 h-6 text-gray-700 mr-2" />
                        Tareas
                    </h3>

                    @if($board->user_id === auth()->id())
                    <!-- Botón para Crear Tarea -->
                    <a href="{{ route('boards.tasks.create', $board) }}" 
                       class="mt-2 inline-flex items-center bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
                        <x-heroicon-o-plus class="w-5 h-5 mr-1" /> Crear Tarea
                    </a>
                    @endif
                    <ul class="mt-4">
                        @forelse ($board->tasks as $task)
                            @if($board->user_id === auth()->id() || $task->users->contains(auth()->user()))
                                <li class="border-b py-3 flex items-center">
                                        
                                    <!-- Enlace al detalle de la tarea -->
                                    <div class="flex-1">
                                        <a href="{{ route('tasks.show', $task->id) }}" 
                                        class="hover:bg-gray-100 text-blue-500 hover:text-blue-700 font-medium">
                                            <x-heroicon-o-document-text class="w-5 h-5 text-gray-600 mr-2 inline-block" />
                                            {{ $task->title }}
                                        </a>
                                    </div>
                                    <!-- Dropdown de estado -->
                                    @livewire('update-task-status', ['task' => $task])

                                    @if($board->user_id === auth()->id())
                                    <!-- Botón de eliminar -->
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="this.disabled=true;this.form.submit();" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition flex items-center">
                                            <x-heroicon-o-trash class="w-5 h-5 mr-1" /> Eliminar
                                        </button>
                                    </form>
                                    @endif
                                </li>
                            @endif
                        @empty
                            <li class="text-gray-500 mt-2">No hay tareas aún.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/boards.js')
</x-app-layout>
