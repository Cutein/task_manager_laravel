<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Tablero') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Nuevo Tablero</h3>

                <form action="{{ route('boards.store') }}" method="POST">
                    @csrf

                    <!-- Nombre del tablero -->
                    <div>
                        <x-label for="name" :value="__('Nombre')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                    </div>

                    <!-- Descripción del Tablero -->
                    <div class="mt-4">
                        <x-label for="description" :value="__('Descripción')" />
                        <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    
                    <!-- Botones -->
                    <div class="mt-4 flex space-x-2">
                        <x-button>
                            {{ __('Crear') }}
                        </x-button>
                        <a href="{{ route('boards.index') }}" class="text-gray-500 hover:underline">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
