<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <x-heroicon-o-presentation-chart-bar class="w-6 h-6 text-blue-500 mr-2" />
                        Tableros
                    </h3>
                    <a href="{{ route('boards.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded flex items-center hover:bg-blue-600">
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
                                    <button type="submit" class="text-red-500 hover:text-red-700 flex items-center">
                                        <x-heroicon-o-trash class="w-5 h-5 mr-1" />
                                        Eliminar
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-gray-500 flex items-center justify-center mt-6">
                        <x-heroicon-o-clipboard class="w-6 h-6 text-gray-400 mr-2" />
                        No tienes tableros aún.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
