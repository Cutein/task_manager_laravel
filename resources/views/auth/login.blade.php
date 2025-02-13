<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center gradient-bg px-6">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
            
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="{{ $settings['app_name'] }}" class="h-10 w-auto">
            </div>

            <!-- Título -->
            <h2 class="text-center text-2xl font-bold text-gray-700">Iniciar Sesión</h2>

            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <!-- Formulario -->
            <form method="POST" action="{{ route('login') }}" class="mt-4">
                @csrf

                <!-- Email -->
                <div>
                    <x-label for="email" value="Correo Electrónico" />
                    <div class="relative">
                        <x-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-heroicon-o-envelope class="absolute left-3 top-3 w-5 h-5 text-gray-400" />
                    </div>
                </div>

                <!-- Contraseña -->
                <div class="mt-4">
                    <x-label for="password" value="Contraseña" />
                    <div class="relative">
                        <x-input id="password" class="block mt-1 w-full pl-10" type="password" name="password" required autocomplete="current-password" />
                        <x-heroicon-o-lock-closed class="absolute left-3 top-3 w-5 h-5 text-gray-400" />
                    </div>
                </div>

                <!-- Recordarme -->
                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600">Recordarme</span>
                    </label>
                </div>

                <!-- Botón & Olvidé mi contraseña -->
                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-500 hover:text-blue-700" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif

                    <x-button class="bg-indigo-500 hover:bg-indigo-600 transition text-white px-4 py-2 rounded-md shadow">
                        Iniciar Sesión
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
