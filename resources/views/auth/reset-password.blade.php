<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center gradient-bg px-6">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
            
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <x-authentication-card-logo class="w-16 h-16" />
            </div>

            <!-- Título -->
            <h2 class="text-center text-2xl font-bold text-gray-700">Restablecer Contraseña</h2>

            <x-validation-errors class="mb-4" />

            <!-- Formulario -->
            <form method="POST" action="{{ route('password.update') }}" class="mt-4">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div class="mt-4">
                    <x-label for="email" value="Correo Electrónico" />
                    <div class="relative">
                        <x-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-heroicon-o-envelope class="absolute left-3 top-3 w-5 h-5 text-gray-400" />
                    </div>
                </div>

                <!-- Nueva Contraseña -->
                <div class="mt-4">
                    <x-label for="password" value="Nueva Contraseña" />
                    <div class="relative">
                        <x-input id="password" class="block mt-1 w-full pl-10" type="password" name="password" required autocomplete="new-password" />
                        <x-heroicon-o-lock-closed class="absolute left-3 top-3 w-5 h-5 text-gray-400" />
                    </div>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mt-4">
                    <x-label for="password_confirmation" value="Confirmar Contraseña" />
                    <div class="relative">
                        <x-input id="password_confirmation" class="block mt-1 w-full pl-10" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-heroicon-o-lock-closed class="absolute left-3 top-3 w-5 h-5 text-gray-400" />
                    </div>
                </div>

                <!-- Botón de Restablecer -->
                <div class="flex items-center justify-center mt-6">
                    <x-button class="bg-blue-500 hover:bg-blue-600 transition text-white px-4 py-2 rounded-md shadow">
                        Restablecer Contraseña
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
