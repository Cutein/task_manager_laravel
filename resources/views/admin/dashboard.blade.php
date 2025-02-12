<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Panel de Administración</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Gestión de Usuarios -->
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-semibold mb-2">Usuarios</h2>
                <p class="text-gray-600">Administrar usuarios y roles.</p>
                <a href="{{ route('admin.users') }}" class="text-blue-500 hover:underline">Ver detalles</a>
            </div>

            <!-- Gestión de Tableros -->
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-semibold mb-2">Tableros</h2>
                <p class="text-gray-600">Gestionar tableros y tareas.</p>
                <a href="{{ route('admin.boards') }}" class="text-blue-500 hover:underline">Ver detalles</a>
            </div>

            <!-- Reportes y Estadísticas -->
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-semibold mb-2">Reportes</h2>
                <p class="text-gray-600">Ver estadísticas del sistema.</p>
                <a href="{{ route('admin.reports') }}" class="text-blue-500 hover:underline">Ver detalles</a>
            </div>
        </div>
    </div>
</x-app-layout>
