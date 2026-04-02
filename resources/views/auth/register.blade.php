<x-guest-layout>
    <div class="flex flex-col gap-8">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-100">{{ __('Crear una cuenta') }}</h2>
            <p class="text-sm text-gray-400 mt-2">{{ __('Ingresa tus datos para registrarte en el sistema') }}</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Name -->
            <div class="space-y-1.5 text-gray-100">
                <x-input-label for="name" :value="__('Nombre Completo')" />
                <x-text-input 
                    name="name" 
                    id="name" 
                    class="block w-full py-2.5 px-4" 
                    type="text" 
                    :value="old('name')" 
                    required 
                    autofocus 
                    placeholder="Juan Pérez"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
            </div>

            <!-- Email Address -->
            <div class="space-y-1.5 text-gray-100">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input 
                    name="email" 
                    id="email" 
                    class="block w-full py-2.5 px-4" 
                    type="email" 
                    :value="old('email')" 
                    required 
                    placeholder="tucorreo@ejemplo.com"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
            </div>

            <!-- Password -->
            <div class="space-y-1.5 text-gray-100">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input 
                    name="password" 
                    id="password" 
                    class="block w-full py-2.5 px-4" 
                    type="password" 
                    required 
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-1.5 text-gray-100">
                <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                <x-text-input 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="block w-full py-2.5 px-4" 
                    type="password" 
                    required 
                    autocomplete="new-password"
                    placeholder="••••••••"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
            </div>

            <div class="flex flex-col gap-4 mt-2">
                <x-primary-button class="w-full justify-center py-3 text-sm font-bold tracking-widest shadow-[0_0_20px_rgba(192,38,211,0.3)] hover:shadow-[0_0_30px_rgba(192,38,211,0.5)] transition-all">
                    {{ __('CREAR CUENTA') }}
                </x-primary-button>
            </div>
        </form>

        <div class="text-center">
            <span class="text-sm text-gray-400">{{ __('¿Ya tienes cuenta?') }}</span>
            <a href="{{ route('login') }}" class="text-sm text-fuchsia-400 hover:text-fuchsia-300 font-bold ml-1 transition-colors">
                {{ __('Inicia sesión') }}
            </a>
        </div>
    </div>
</x-guest-layout>
