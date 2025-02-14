<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nueva Tarea en ' . $board->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('boards.tasks.store', $board) }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700">Título</label>
                        <input type="text" name="title" 
                               class="w-full border-gray-300 rounded-md shadow-sm" 
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Descripción</label>
                        <textarea name="description" rows="3"
                                  class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="due_date">Fecha de vencimiento:</label>
                        <input type="date" name="due_date">
                 
                    </div>
                    
                    <div class="mb-4">
                        <label for="tags">Etiquetas (separadas por comas):</label>
                        <input type="text" name="tags[]">
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
                    <div class="flex justify-end">
                        <a href="{{ route('boards.show', $board) }}" 
                           class="mr-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-black">Cancelar</a>
                        <button type="submit" onclick="this.disabled=true;this.form.submit();" 
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Guardar Tarea
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @vite('resources/js/task-users.js')
</x-app-layout>
