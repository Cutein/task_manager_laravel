<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-2xl font-bold mb-6 flex items-center">
                <x-heroicon-o-cog class="w-7 h-7 text-gray-700 mr-2" />
                Panel de Administración
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Gestión de Usuarios -->
                <div class="bg-white p-5 shadow-lg rounded-lg flex flex-col">
                    <div class="flex items-center mb-3">
                        <x-heroicon-o-users class="w-6 h-6 text-blue-600 mr-2" />
                        <h2 class="text-lg font-semibold">Usuarios</h2>
                    </div>
                    <p class="text-gray-600 flex-grow">Administrar usuarios y roles.</p>
                    <a href="{{ route('admin.users') }}" 
                    class="mt-3 text-blue-600 hover:text-blue-700 font-medium flex items-center">
                        Ver detalles <x-heroicon-o-arrow-right class="w-4 h-4 ml-1" />
                    </a>
                </div>

                <!-- Gestión de Tableros -->
                <div class="bg-white p-5 shadow-lg rounded-lg flex flex-col">
                    <div class="flex items-center mb-3">
                        <x-heroicon-o-presentation-chart-bar class="w-6 h-6 text-green-600 mr-2" />
                        <h2 class="text-lg font-semibold">Tableros</h2>
                    </div>
                    <p class="text-gray-600 flex-grow">Gestionar tableros.</p>
                    <a href="{{ route('admin.boards') }}" 
                    class="mt-3 text-blue-600 hover:text-blue-700 font-medium flex items-center">
                        Ver detalles <x-heroicon-o-arrow-right class="w-4 h-4 ml-1" />
                    </a>
                </div>

                <!-- Gestión de Tareas -->
                <div class="bg-white p-5 shadow-lg rounded-lg flex flex-col">
                    <div class="flex items-center mb-3">
                        <x-heroicon-o-clipboard-document-list class="w-6 h-6 text-yellow-600 mr-2" />
                        <h2 class="text-lg font-semibold">Tareas</h2>
                    </div>
                    <p class="text-gray-600 flex-grow">Gestionar tareas.</p>
                    <a href="{{ route('admin.tasks') }}" 
                    class="mt-3 text-blue-600 hover:text-blue-700 font-medium flex items-center">
                        Ver detalles <x-heroicon-o-arrow-right class="w-4 h-4 ml-1" />
                    </a>
                </div>

                <!-- Reportes y Estadísticas -->
                <div class="bg-white p-5 shadow-lg rounded-lg flex flex-col">
                    <div class="flex items-center mb-3">
                        <x-heroicon-o-chart-bar class="w-6 h-6 text-purple-600 mr-2" />
                        <h2 class="text-lg font-semibold">Reportes</h2>
                    </div>
                    <p class="text-gray-600 flex-grow">Ver estadísticas del sistema.</p>
                    <a href="{{ route('admin.reports') }}" 
                    class="mt-3 text-blue-600 hover:text-blue-700 font-medium flex items-center">
                        Ver detalles <x-heroicon-o-arrow-right class="w-4 h-4 ml-1" />
                    </a>
                </div>

                <!-- Configuración General -->
                <div class="bg-white p-5 shadow-lg rounded-lg flex flex-col">
                    <div class="flex items-center mb-3">
                        <x-heroicon-o-adjustments-horizontal class="w-6 h-6 text-red-600 mr-2" />
                        <h2 class="text-lg font-semibold">Configuración General</h2>
                    </div>
                    <p class="text-gray-600 flex-grow">Ver configuraciones del sistema.</p>
                    <a href="{{ route('admin.settings') }}" 
                    class="mt-3 text-blue-600 hover:text-blue-700 font-medium flex items-center">
                        Ver detalles <x-heroicon-o-arrow-right class="w-4 h-4 ml-1" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
