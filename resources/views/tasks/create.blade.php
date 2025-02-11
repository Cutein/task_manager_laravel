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

                    <div class="flex justify-end">
                        <a href="{{ route('boards.show', $board) }}" 
                           class="mr-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-black">Cancelar</a>
                        <button type="submit" 
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Guardar Tarea
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
