<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-800">Bienvenido a TaskManager 🎯</h3>

                {{-- Estadísticas Generales --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                    {{-- Total de Tableros --}}
                    <div class="bg-blue-100 p-4 rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-500 text-white rounded-full">
                                <x-heroicon-s-presentation-chart-bar class="w-6 h-6 text-red-300 fill-white" />
                            </div>
                            <div class="ml-3">
                                <h4 class="text-lg font-semibold text-gray-800">{{ $totalBoards }}</h4>
                                <p class="text-gray-600 text-sm">Tableros</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Total de Tareas --}}
                    <div class="bg-green-100 p-4 rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-500 text-white rounded-full">
                                <x-heroicon-s-clipboard-document-list class="w-6 h-6 text-red-300 fill-white" />
                            </div>
                            <div class="ml-3">
                                <h4 class="text-lg font-semibold text-gray-800">{{ $totalTasks }}</h4>
                                <p class="text-gray-600 text-sm">Tareas</p>
                            </div>
                        </div>
                    </div>

                    {{-- Tareas Pendientes --}}
                    <div class="bg-yellow-100 p-4 rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-500 text-white rounded-full">
                                <x-heroicon-s-ellipsis-horizontal-circle class="w-6 h-6 text-red-300 fill-white" />
                            </div>
                            <div class="ml-3">
                                <h4 class="text-lg font-semibold text-gray-800">{{ $pendingTasks }}</h4>
                                <p class="text-gray-600 text-sm">Pendientes</p>
                            </div>
                        </div>
                    </div>

                    {{-- Tareas Completadas --}}
                    <div class="bg-purple-100 p-4 rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-500 text-white rounded-full">
                                <x-heroicon-s-clipboard-document-check class="w-6 h-6 text-red-300 fill-white" />
                            </div>
                            <div class="ml-3">
                                <h4 class="text-lg font-semibold text-gray-800">{{ $completedTasks }}</h4>
                                <p class="text-gray-600 text-sm">Completadas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
