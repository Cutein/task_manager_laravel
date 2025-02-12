<x-app-layout>
    <div class="max-w-6xl mx-auto py-6">
        <h2 class="text-2xl font-semibold mb-4">📊 Reportes y Estadísticas</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 shadow rounded text-center">
                <h3 class="text-lg font-semibold">Usuarios Totales</h3>
                <p class="text-2xl font-bold">{{ $totalUsers }}</p>
            </div>

            <div class="bg-white p-4 shadow rounded text-center">
                <h3 class="text-lg font-semibold">Usuarios Activos</h3>
                <p class="text-2xl font-bold">{{ $activeUsers }}</p>
            </div>

            <div class="bg-white p-4 shadow rounded text-center">
                <h3 class="text-lg font-semibold">Total de Tableros</h3>
                <p class="text-2xl font-bold">{{ $totalBoards }}</p>
            </div>

            <div class="bg-white p-4 shadow rounded text-center">
                <h3 class="text-lg font-semibold">Total de Tareas</h3>
                <p class="text-2xl font-bold">{{ $totalTasks }}</p>
            </div>

            <div class="bg-white p-4 shadow rounded text-center">
                <h3 class="text-lg font-semibold">Tareas Completadas</h3>
                <p class="text-2xl font-bold text-green-600">{{ $completedTasks }}</p>
            </div>

            <div class="bg-white p-4 shadow rounded text-center">
                <h3 class="text-lg font-semibold">Tareas Pendientes</h3>
                <p class="text-2xl font-bold text-red-600">{{ $pendingTasks }}</p>
            </div>
        </div>

        <div class="bg-white p-6 shadow rounded mt-6">
            <h3 class="text-xl font-semibold mb-4">📌 Tareas por Tablero</h3>
            <table class="w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4">Tablero</th>
                        <th class="py-2 px-4">Total de Tareas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasksByBoard as $board)
                        <tr class="border-t">
                            <td class="py-2 px-4">{{ $board->name }}</td>
                            <td class="py-2 px-4">{{ $board->tasks_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-white p-6 shadow rounded mt-6">
            <h3 class="text-xl font-semibold mb-4">👤 Tareas por Usuario</h3>
            <table class="w-full bg-white shadow-md rounded">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4">Usuario</th>
                        <th class="py-2 px-4">Total de Tareas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasksByUser as $user)
                        <tr class="border-t">
                            <td class="py-2 px-4">{{ $user->name }}</td>
                            <td class="py-2 px-4">{{ $user->tasks_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
