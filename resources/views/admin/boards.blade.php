<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        <h2 class="text-2xl font-semibold mb-4">Gestión de Tableros</h2>

        <table class="w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4">Nombre</th>
                    <th class="py-2 px-4">Id Usuario</th>
                    <th class="py-2 px-4">Nombre Usuario</th>
                    <th class="py-2 px-4">Total Tareas</th>
                    <th class="py-2 px-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($boards as $board)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $board->name }}</td>
                        <td class="py-2 px-4">{{ $board->user->id }}</td>
                        <td class="py-2 px-4">{{ $board->user->name }}</td>
                        <td class="py-2 px-4">{{ ($board->tasks) ? $board->tasks->count() : 0 }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('admin.boards.edit', $board) }}" class="text-blue-500">✏️ Editar</a>
                            <form action="{{ route('admin.boards.delete', $board) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 ml-2" onclick="return confirm('¿Eliminar este tablero?')">🗑 Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
