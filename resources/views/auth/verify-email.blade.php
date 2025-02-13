<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center gradient-bg px-6">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
            
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="{{ $settings['app_name'] }}" class="h-10 w-auto">
            </div>

            <div class="text-center">
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ __('Verify Your Email') }}
                </h2>

                <p class="mt-2 text-sm text-gray-600">
                    {{ __('Before continuing, please verify your email address by clicking the link in the email we just sent you. If you did not receive the email, we can send you another.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mt-4 p-3 text-sm text-green-600 bg-green-100 border border-green-400 rounded-md">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </div>
                @endif

                <div class="mt-6 flex flex-col space-y-4">
                    <!-- Botón para reenviar email -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <x-button type="submit" class="w-full flex justify-center items-center gap-2 py-3 text-lg font-semibold">
                            <x-heroicon-o-envelope class="w-5 h-5" />
                            <span>{{ __('Resend Verification Email') }}</span>
                        </x-button>
                    </form>

                    <div class="flex justify-between w-full">
                        <!-- Editar perfil -->
                        <a href="{{ route('profile.show') }}"
                            class="text-sm font-medium text-gray-700 hover:text-blue-600 transition">
                            {{ __('Edit Profile') }}
                        </a>

                        <!-- Cerrar sesión -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-sm font-medium text-gray-700 hover:text-red-600 transition">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
