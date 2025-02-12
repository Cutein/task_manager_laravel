<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        <h2 class="text-2xl font-semibold mb-4">Editar Tarea</h2>

        <form action="{{ route('admin.tasks.update', $task) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block font-medium">Título:</label>
                <input type="text" id="title" name="title" value="{{ $task->title }}" class="w-full border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium">Descripción:</label>
                <textarea id="description" name="description" class="w-full border-gray-300 rounded">{{ $task->description }}</textarea>
            </div>

            <div class="mb-4">
                <label for="due_date" class="block font-medium">Fecha de Vencimiento:</label>
                <input type="date" name="due_date" 
                value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
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
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
            </div>
        </form>
    </div>
    @vite('resources/js/task-users.js')
</x-app-layout>
