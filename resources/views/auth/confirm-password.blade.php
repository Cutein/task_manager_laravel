<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center gradient-bg px-6">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
            
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="{{ $settings['app_name'] }}" class="h-10 w-auto">
            </div>

            <!-- Título -->
            <h2 class="text-center text-2xl font-bold text-gray-700">Confirmar Contraseña</h2>

            <div class="mt-2 text-sm text-gray-600 text-center">
                Esta es una zona segura de la aplicación. Confirma tu contraseña antes de continuar.
            </div>

            <x-validation-errors class="mb-4" />

            <!-- Formulario -->
            <form method="POST" action="{{ route('password.confirm') }}" class="mt-4">
                @csrf

                <!-- Contraseña -->
                <div class="mt-4">
                    <x-label for="password" value="Contraseña" />
                    <div class="relative">
                        <x-input id="password" class="block mt-1 w-full pl-10" type="password" name="password" required autocomplete="current-password" autofocus />
                        <x-heroicon-o-lock-closed class="absolute left-3 top-3 w-5 h-5 text-gray-400" />
                    </div>
                </div>

                <!-- Botón de confirmación -->
                <div class="flex items-center justify-center mt-6">
                    <x-button class="bg-red-500 hover:bg-red-600 transition text-white px-4 py-2 rounded-md shadow">
                        Confirmar
                    </x-button>
                </div>

                <!-- Enlace para volver -->
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700 text-sm">Volver al inicio de sesión</a>
                </div>

            </form>
        </div>
    </div>
</x-guest-layout>
