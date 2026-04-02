<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased bg-gray-900 text-gray-100">
        <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10 bg-gradient-to-br from-gray-900 via-gray-800 to-black">
            <div class="flex w-full max-w-md flex-col gap-4">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium mb-6" wire:navigate>
                    <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-fuchsia-500/20 border border-fuchsia-500/40 shadow-[0_0_25px_rgba(217,70,239,0.4)] transition-all hover:shadow-[0_0_35px_rgba(217,70,239,0.6)]">
                        <x-app-logo-icon class="size-10 fill-current text-fuchsia-400" />
                    </span>
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <div class="flex flex-col gap-8 p-10 bg-gray-900/60 backdrop-blur-2xl border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.5)] rounded-3xl relative overflow-hidden group">
                    <!-- Subtle shine effect -->
                    <div class="absolute -top-[100%] -left-[100%] w-[300%] h-[300%] bg-[radial-gradient(circle,rgba(217,70,239,0.05)_0%,transparent_70%)] pointer-events-none"></div>
                    
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
