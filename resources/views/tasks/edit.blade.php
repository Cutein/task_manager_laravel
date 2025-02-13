<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 flex items-center">
                    <x-heroicon-o-pencil-square class="w-5 h-5 text-gray-700 mr-2" />
                    Editar Tarea
                </h3>

                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Título -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 flex items-center">
                            <x-heroicon-o-pencil class="w-5 h-5 text-gray-500 mr-2" />
                            Título
                        </label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 p-2">
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 flex items-center">
                            <x-heroicon-o-chat-bubble-left-right class="w-5 h-5 text-gray-500 mr-2" />
                            Descripción
                        </label>
                        <textarea name="description" rows="3" 
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 p-2">{{ old('description', $task->description) }}</textarea>
                    </div>

                    <!-- Fecha de vencimiento -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 flex items-center">
                            <x-heroicon-o-calendar class="w-5 h-5 text-gray-500 mr-2" />
                            Fecha de vencimiento
                        </label>
                        <input type="date" name="due_date" 
                               value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 p-2">
                    </div>

                    <!-- Etiquetas -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 flex items-center">
                            <x-heroicon-o-tag class="w-5 h-5 text-gray-500 mr-2" />
                            Etiquetas (separadas por comas)
                        </label>
                        <input type="text" name="tags" 
                               value="{{ old('tags', isset($task) ? implode(',', $task->tags) : '') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 p-2">
                    </div>

                    <!-- Asignar Usuarios -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 flex items-center">
                            <x-heroicon-o-user-group class="w-5 h-5 text-gray-500 mr-2" />
                            Asignar Usuarios
                        </label>
                        <select id="user-select" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 p-2">
                            <option value="">Seleccione un usuario</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Lista de usuarios seleccionados -->
                    <div id="selected-users" class="mt-2">
                        @foreach($task->users as $user)
                            <span data-id="{{ $user->id }}" class="bg-gray-200 text-gray-800 px-2 py-1 rounded mr-2 inline-block">
                                {{ $user->name }}
                                <button class="ml-1 text-red-500 text-sm">×</button>
                            </span>
                        @endforeach
                    </div>

                    <!-- Campo oculto para enviar los IDs seleccionados -->
                    <input type="hidden" name="users[]" id="users-input">

                    <!-- Botones de acción -->
                    <div class="flex space-x-2 mt-6">
                        <button type="submit" 
                                class="flex items-center bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
                            <x-heroicon-o-check class="w-5 h-5 mr-2" />
                            Guardar
                        </button>
                        <a href="{{ route('boards.show', $task->board) }}" 
                           class="flex items-center bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition">
                            <x-heroicon-o-x-mark class="w-5 h-5 mr-2" />
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @vite('resources/js/task-users.js')
</x-app-layout>
