<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold">Bienvenido a TaskManager</h3>
                <p class="text-gray-600">Aquí podrás gestionar tus tareas y tableros.</p>
                <a href="{{ route('boards.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
                    Ver Tableros
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
