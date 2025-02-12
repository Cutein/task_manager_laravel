<x-app-layout>
    @php
        $notifications = auth()->user()->unreadNotifications;
    @endphp

    <div class="relative">
        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            🔔 Notificaciones ({{ $notifications->count() }})
        </button>
        
        <div class="absolute bg-white shadow-md mt-2 w-64 rounded-lg">
            @forelse($notifications as $notification)
                <div class="p-2 border-b">
                    <p><strong>{{ $notification->data['task_title'] }}</strong></p>
                    <p>Asignado por: {{ $notification->data['assigned_by'] }}</p>
                    <a href="{{ route('tasks.show', $notification->data['task_id']) }}" class="text-blue-500">Ver tarea</a>
                    <button class="text-sm text-gray-500" onclick="markNotificationAsRead('{{ $notification->id }}')">
                        Marcar como leída
                    </button>
                </div>
            @empty
                <p class="p-2">No hay notificaciones</p>
            @endforelse
        </div>
    </div>

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
    @vite('resources/js/notifications.js')
</x-app-layout>
