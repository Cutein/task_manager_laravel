<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Tarea
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Editar Tarea</h3>

                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Título</label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Descripción</label>
                        <textarea name="description" class="w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $task->description) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="due_date">Fecha de vencimiento:</label>
                        <input type="date" name="due_date" 
                        value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
                 
                    </div>
                    
                    <div class="mb-4">
                        <label for="tags">Etiquetas (separadas por comas):</label>
                        <input type="text" name="tags[]" value="{{ old('tags', isset($task) ? implode(',', $task->tags) : '') }}">
                    </div>
                    <div class="mb-4">
                        <label for="user-select">Asignar usuarios:</label>
                        <select id="user-select" class="w-64 border rounded px-2 py-1">
                            <option value="">Seleccione un usuario</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>                      
                    </div>
                    
                    <!-- Aquí se mostrarán los usuarios seleccionados -->
                    <div id="selected-users" class="mt-2">
                        @foreach($task->users as $user)
                            <span data="id-{{ $user->id }}" class="bg-gray-200 text-gray-800 px-2 py-1 rounded mr-2 inline-block"> {{ $user->name }}<button class="ml-1 text-red-500 text-sm">×</button></span>
                        @endforeach
                    </div>

                    <!-- Campo oculto para enviar los IDs seleccionados -->
                    <input type="hidden" name="users[]" id="users-input">

                    <div class="flex space-x-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
                        <a href="{{ route('boards.show', $task->board) }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @vite('resources/js/task-users.js')
</x-app-layout>
