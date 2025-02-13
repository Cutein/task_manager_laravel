<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center gradient-bg px-6">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
            
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="{{ $settings['app_name'] }}" class="h-10 w-auto">
            </div>

            <!-- Título -->
            <h2 class="text-center text-2xl font-bold text-gray-700">Recuperar Contraseña</h2>

            <div class="mt-2 text-sm text-gray-600 text-center">
                ¿Olvidaste tu contraseña? No hay problema. Ingresa tu correo y te enviaremos un enlace para restablecerla.
            </div>

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <x-validation-errors class="mb-4" />

            <!-- Formulario -->
            <form method="POST" action="{{ route('password.email') }}" class="mt-4">
                @csrf

                <!-- Email -->
                <div class="mt-4">
                    <x-label for="email" value="Correo Electrónico" />
                    <div class="relative">
                        <x-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-heroicon-o-envelope class="absolute left-3 top-3 w-5 h-5 text-gray-400" />
                    </div>
                </div>

                <!-- Botón de recuperación -->
                <div class="flex items-center justify-center mt-6">
                    <x-button class="bg-indigo-500 hover:bg-indigo-600 transition text-white px-4 py-2 rounded-md shadow">
                        Enviar enlace de recuperación
                    </x-button>
                </div>

                <!-- Volver al login -->
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700 text-sm">Volver al inicio de sesión</a>
                </div>

            </form>
        </div>
    </div>
</x-guest-layout>
