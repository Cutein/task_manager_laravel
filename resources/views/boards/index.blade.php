<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex items-left mb-6 relative">
                    <h3 class="inline-block text-xl font-bold text-gray-800 flex items-center">
                        <x-heroicon-o-presentation-chart-bar class="w-6 h-6 text-blue-500 mr-2" />
                        Mis Tableros
                    </h3>
                    <h3 class="ml-3 inline-block text-xl font-bold text-gray-800 flex items-center">
                        <x-heroicon-o-presentation-chart-bar class="w-6 h-6 text-green-500 mr-2" />
                        Tableros Asignados
                    </h3>
                    <a href="{{ route('boards.create') }}" class="absolute right-0 ml-3 bg-blue-500 text-white px-4 py-2 rounded flex items-center hover:bg-blue-600">
                        <x-heroicon-o-plus class="w-5 h-5 mr-2" />
                        Crear Tablero
                    </a>
                </div>

                @if ($boards->isNotEmpty())
                    <ul class="space-y-4">
                        @foreach ($boards as $board)
                            <li class="flex justify-between items-center bg-gray-100 px-4 py-3 rounded-lg shadow-sm">
                                <a href="{{ route('boards.show', $board) }}" class="flex items-center text-blue-600 hover:underline">
                                    <x-heroicon-o-presentation-chart-bar class="w-6 h-6 text-blue-400 mr-2" />
                                    {{ $board->name }}
                                </a>
                                <form action="{{ route('boards.destroy', $board) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este tablero?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="this.disabled=true;this.form.submit();"  class="text-red-500 hover:text-red-700 flex items-center">
                                        <x-heroicon-o-trash class="w-5 h-5 mr-1" />
                                        Eliminar
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
                @if($boardsWithAssignedTasks->isNotEmpty())
                    <ul class="space-y-4">
                        @foreach ($boardsWithAssignedTasks as $boardAssignedTask)
                            <li class="flex justify-between items-center bg-gray-100 px-4 py-3 rounded-lg shadow-sm">
                                <a href="{{ route('boards.show', $boardAssignedTask) }}" class="flex items-center text-black hover:underline">
                                    <x-heroicon-o-presentation-chart-bar class="w-6 h-6 text-green-400 mr-2" />
                                    {{ $boardAssignedTask->name }}
                                </a>
                                <form action="{{ route('boards.destroy', $boardAssignedTask) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este tablero?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 flex items-center">
                                        <x-heroicon-o-trash class="w-5 h-5 mr-1" />
                                        Eliminar
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
                @if ($boards->isEmpty() && $boardsWithAssignedTasks->isEmpty())
                    <div class="text-gray-500 flex items-center justify-center mt-6">
                        <x-heroicon-o-clipboard class="w-6 h-6 text-gray-400 mr-2" />
                        No tienes tableros aún.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
