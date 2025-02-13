<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-4">Gestión de Tareas</h2>

                <table class="w-full bg-white shadow-md rounded">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4">ID</th>
                            <th class="py-2 px-4">Título</th>
                            <th class="py-2 px-4">Descripción</th>
                            <th class="py-2 px-4">Tablero</th>
                            <th class="py-2 px-4">Usuarios Asignados</th>
                            <th class="py-2 px-4">Fecha Vencimiento</th>
                            <th class="py-2 px-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr class="border-t">
                                <td class="py-2 px-4">{{ $task->id }}</td>
                                <td class="py-2 px-4">{{ $task->title }}</td>
                                <td class="py-2 px-4">{{ Str::limit($task->description, 50) }}</td>
                                <td class="py-2 px-4">{{ $task->board->name ?? 'Sin tablero' }}</td>
                                <td class="py-2 px-4">
                                    @foreach ($task->users as $user)
                                        <span class="bg-gray-200 text-sm px-2 py-1 rounded">{{ $user->name }}</span>
                                    @endforeach
                                </td>
                                <td class="py-2 px-4">{{ $task->due_date ? $task->due_date->format('d/m/Y') : 'Sin fecha' }}</td>
                                <td class="py-2 px-4">
                                    <a href="{{ route('admin.tasks.edit', $task) }}" class="text-blue-500">✏️ Editar</a>
                                    <form action="{{ route('admin.tasks.delete', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 ml-2" onclick="return confirm('¿Eliminar esta tarea?')">🗑 Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
