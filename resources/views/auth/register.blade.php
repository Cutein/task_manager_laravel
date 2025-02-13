<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center gradient-bg px-6">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
            
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="{{ $settings['app_name'] }}" class="h-10 w-auto">
            </div>

            <!-- Título -->
            <h2 class="text-center text-2xl font-bold text-gray-700">Crear Cuenta</h2>

            <x-validation-errors class="mb-4" />

            <!-- Formulario -->
            <form method="POST" action="{{ route('register') }}" class="mt-4">
                @csrf

                <!-- Nombre -->
                <div>
                    <x-label for="name" value="Nombre" />
                    <div class="relative">
                        <x-input id="name" class="block mt-1 w-full pl-10" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-heroicon-o-user class="absolute left-3 top-3 w-5 h-5 text-gray-400" />
                    </div>
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-label for="email" value="Correo Electrónico" />
                    <div class="relative">
                        <x-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-heroicon-o-envelope class="absolute left-3 top-3 w-5 h-5 text-gray-400" />
                    </div>
                </div>

                <!-- Contraseña -->
                <div class="mt-4">
                    <x-label for="password" value="Contraseña" />
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

                <!-- Aceptar Términos -->
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4 flex items-start">
                        <x-checkbox name="terms" id="terms" required />
                        <span class="ms-2 text-sm text-gray-600">
                            Acepto los 
                            <a target="_blank" href="{{ route('terms.show') }}" class="text-blue-500 hover:underline">Términos de Servicio</a> 
                            y la 
                            <a target="_blank" href="{{ route('policy.show') }}" class="text-blue-500 hover:underline">Política de Privacidad</a>.
                        </span>
                    </div>
                @endif

                <!-- Botón de Registro -->
                <div class="flex items-center justify-between mt-4">
                    <a class="text-sm text-blue-500 hover:text-blue-700" href="{{ route('login') }}">
                        ¿Ya tienes una cuenta?
                    </a>

                    <x-button class="bg-indigo-500 hover:bg-indigo-600 transition text-white px-4 py-2 rounded-md shadow">
                        Registrarse
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
