<x-layouts.auth>
    <div class="flex flex-col gap-8">
        <x-auth-header :title="__('Bienvenido de nuevo')" :description="__('Ingresa tus credenciales para acceder al panel de gestión')" />

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <div class="space-y-1.5 focus-within:z-10 text-gray-100">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input 
                    name="email" 
                    id="email" 
                    class="block w-full text-base sm:text-sm py-2.5 px-4" 
                    type="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    placeholder="tucorreo@ejemplo.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
            </div>

            <!-- Password -->
            <div class="space-y-1.5 text-gray-100">
                <div class="flex items-center justify-between">
                    <x-input-label for="password" :value="__('Contraseña')" />
                    @if (Route::has('password.request'))
                        <a class="text-xs text-fuchsia-400 hover:text-fuchsia-300 transition-colors font-medium" href="{{ route('password.request') }}" wire:navigate>
                            {{ __('¿Olvidaste tu contraseña?') }}
                        </a>
                    @endif
                </div>
                <x-text-input 
                    name="password" 
                    id="password" 
                    class="block w-full text-base sm:text-sm py-2.5 px-4" 
                    type="password" 
                    required 
                    autocomplete="current-password"
                    placeholder="••••••••"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-2">
                <label for="remember" class="inline-flex items-center group cursor-pointer">
                    <input id="remember" type="checkbox" class="rounded border-gray-700 bg-gray-900/50 text-fuchsia-600 shadow-sm focus:ring-fuchsia-500 focus:ring-offset-gray-900" name="remember">
                    <span class="ms-2 text-sm text-gray-400 group-hover:text-gray-300 transition-colors">{{ __('Mantener sesión iniciada') }}</span>
                </label>
            </div>

            <div class="flex flex-col gap-4">
                <x-primary-button class="w-full justify-center py-3 text-sm font-bold tracking-widest shadow-[0_0_20px_rgba(192,38,211,0.3)] hover:shadow-[0_0_30px_rgba(192,38,211,0.5)] transition-all">
                    {{ __('INICIAR SESIÓN') }}
                </x-primary-button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="text-center">
                <span class="text-sm text-gray-400">{{ __('¿No tienes cuenta?') }}</span>
                <a href="{{ route('register') }}" class="text-sm text-fuchsia-400 hover:text-fuchsia-300 font-bold ml-1 transition-colors" wire:navigate>
                    {{ __('Regístrate aquí') }}
                </a>
            </div>
        @endif
    </div>
</x-layouts.auth>
