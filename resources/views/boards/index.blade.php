<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Tableros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Tableros</h3>

                <a href="{{ route('boards.create') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
                    Crear Tablero
                </a>

                @if ($boards->isNotEmpty())
                    <ul class="list-disc pl-5">
                        @foreach ($boards as $board)
                            <li class="mb-2">
                                <a href="{{ route('boards.show', $board) }}" class="text-blue-600 hover:underline">
                                    {{ $board->name }}
                                </a>
                                <form action="{{ route('boards.destroy', $board) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">
                                        Eliminar
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No tienes tableros aún.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
