<x-app-layout>
    <div class="max-w-6xl mx-auto py-6">
        <h2 class="text-2xl font-semibold mb-6 flex items-center">
            <x-heroicon-o-chart-bar class="w-7 h-7 text-gray-700 mr-2" />
            Reportes y Estadísticas
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
            <!-- Tarjeta de Estadística -->
            <div class="bg-white p-5 shadow-lg rounded text-center flex flex-col items-center">
                <x-heroicon-o-users class="w-10 h-10 text-blue-600 mb-2" />
                <h3 class="text-lg font-semibold">Usuarios Totales</h3>
                <p class="text-2xl font-bold text-blue-700">{{ $totalUsers }}</p>
            </div>

            <div class="bg-white p-5 shadow-lg rounded text-center flex flex-col items-center">
                <x-heroicon-o-user-group class="w-10 h-10 text-green-600 mb-2" />
                <h3 class="text-lg font-semibold">Usuarios Activos</h3>
                <p class="text-2xl font-bold text-green-700">{{ $activeUsers }}</p>
            </div>

            <div class="bg-white p-5 shadow-lg rounded text-center flex flex-col items-center">
                <x-heroicon-o-presentation-chart-line class="w-10 h-10 text-purple-600 mb-2" />
                <h3 class="text-lg font-semibold">Total de Tableros</h3>
                <p class="text-2xl font-bold text-purple-700">{{ $totalBoards }}</p>
            </div>

            <div class="bg-white p-5 shadow-lg rounded text-center flex flex-col items-center">
                <x-heroicon-o-clipboard-document-list class="w-10 h-10 text-yellow-600 mb-2" />
                <h3 class="text-lg font-semibold">Total de Tareas</h3>
                <p class="text-2xl font-bold text-yellow-700">{{ $totalTasks }}</p>
            </div>

            <div class="bg-white p-5 shadow-lg rounded text-center flex flex-col items-center">
                <x-heroicon-o-check-circle class="w-10 h-10 text-green-600 mb-2" />
                <h3 class="text-lg font-semibold">Tareas Completadas</h3>
                <p class="text-2xl font-bold text-green-700">{{ $completedTasks }}</p>
            </div>

            <div class="bg-white p-5 shadow-lg rounded text-center flex flex-col items-center">
                <x-heroicon-o-exclamation-circle class="w-10 h-10 text-red-600 mb-2" />
                <h3 class="text-lg font-semibold">Tareas Pendientes</h3>
                <p class="text-2xl font-bold text-red-700">{{ $pendingTasks }}</p>
            </div>
        </div>

        <!-- Tareas por Tablero -->
        <div class="bg-white p-6 shadow-lg rounded-lg mt-6">
            <h3 class="text-xl font-semibold mb-4 flex items-center">
                <x-heroicon-o-presentation-chart-bar class="w-6 h-6 text-blue-600 mr-2" />
                Tareas por Tablero
            </h3>
            <table class="w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="py-3 px-4 text-left">Tablero</th>
                        <th class="py-3 px-4 text-center">Total de Tareas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasksByBoard as $board)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $board->name }}</td>
                            <td class="py-3 px-4 text-center">{{ $board->tasks_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tareas por Usuario -->
        <div class="bg-white p-6 shadow-lg rounded-lg mt-6">
            <h3 class="text-xl font-semibold mb-4 flex items-center">
                <x-heroicon-o-user-circle class="w-6 h-6 text-green-600 mr-2" />
                Tareas por Usuario
            </h3>
            <table class="w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="py-3 px-4 text-left">Usuario</th>
                        <th class="py-3 px-4 text-center">Total de Tareas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasksByUser as $user)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $user->name }}</td>
                            <td class="py-3 px-4 text-center">{{ $user->tasks_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
