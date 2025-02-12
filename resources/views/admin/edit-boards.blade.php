<x-app-layout>
    <div class="max-w-2xl mx-auto py-6">
        <h2 class="text-2xl font-semibold mb-4">Editar Tablero</h2>

        <form action="{{ route('admin.boards.update', $board) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-medium">Nombre del Tablero:</label>
                <input type="text" id="name" name="name" value="{{ $board->name }}" class="w-full border-gray-300 rounded">
            </div>
            <!-- Descripción -->
            <div class="mb-4">
                <label for="description" class="block font-medium text-gray-700">Descripción</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $board->description) }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
            </div>
        </form>
    </div>
</x-app-layout>
