<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center gradient-bg px-6">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
            
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="{{ $settings['app_name'] }}" class="h-10 w-auto">
            </div>

            <div x-data="{ recovery: false }" class="text-center">
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ __('Two-Factor Authentication') }}
                </h2>
                <p class="mt-2 text-sm text-gray-600" x-show="! recovery">
                    {{ __('Enter the authentication code from your app to continue.') }}
                </p>
                <p class="mt-2 text-sm text-gray-600 hidden" x-show="recovery" x-cloak>
                    {{ __('Enter one of your emergency recovery codes to continue.') }}
                </p>

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('two-factor.login') }}" class="mt-6">
                    @csrf

                    <!-- Código de autenticación -->
                    <div class="relative" x-show="! recovery">
                        <x-label for="code" value="{{ __('Authentication Code') }}" class="text-gray-700 font-medium" />
                        <x-input id="code" class="block mt-1 w-full text-center tracking-widest text-lg"
                            type="text" inputmode="numeric" name="code" autofocus x-ref="code"
                            placeholder="123456" autocomplete="one-time-code" />
                    </div>

                    <!-- Código de recuperación -->
                    <div class="relative hidden" x-show="recovery" x-cloak>
                        <x-label for="recovery_code" value="{{ __('Recovery Code') }}" class="text-gray-700 font-medium" />
                        <x-input id="recovery_code" class="block mt-1 w-full text-center text-lg"
                            type="text" name="recovery_code" x-ref="recovery_code"
                            placeholder="abcd-efgh-ijkl-mnop" autocomplete="one-time-code" />
                    </div>

                    <!-- Botones -->
                    <div class="flex flex-col items-center mt-6 space-y-4">
                        <button type="button"
                            class="text-sm font-medium text-blue-600 hover:underline focus:outline-none"
                            x-show="! recovery"
                            x-on:click="
                                recovery = true;
                                $nextTick(() => { $refs.recovery_code.focus() })
                            ">
                            {{ __('Use a recovery code') }}
                        </button>

                        <button type="button"
                            class="text-sm font-medium text-blue-600 hover:underline focus:outline-none hidden"
                            x-show="recovery"
                            x-on:click="
                                recovery = false;
                                $nextTick(() => { $refs.code.focus() })
                            " x-cloak>
                            {{ __('Use an authentication code') }}
                        </button>

                        <x-button class="w-full flex justify-center items-center gap-2 py-3 text-lg font-semibold">
                            <span>{{ __('Log in') }}</span>
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
