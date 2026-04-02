<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Menú') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-gray-800/60 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h3 class="text-2xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-fuchsia-400 to-purple-400">Bienvenido, {{ auth()->user()->name }}</h3>
                    <p class="mb-6 text-gray-400">Desde aquí puedes gestionar todas las operaciones del local.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                        <a href="{{ route('repairs.create') }}" wire:navigate class="block p-6 bg-blue-900/30 border border-blue-500/30 rounded-xl hover:bg-blue-800/50 hover:border-blue-400/50 hover:shadow-[0_0_15px_rgba(59,130,246,0.5)] transition-all duration-300">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-blue-300">Nueva Orden</h5>
                            <p class="font-normal text-blue-200/70">Ingresar un nuevo equipo a reparación.</p>
                        </a>
                        
                        <a href="{{ route('repairs.index') }}" wire:navigate class="block p-6 bg-green-900/30 border border-green-500/30 rounded-xl hover:bg-green-800/50 hover:border-green-400/50 hover:shadow-[0_0_15px_rgba(34,197,94,0.5)] transition-all duration-300">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-green-300">Activas</h5>
                            <p class="font-normal text-green-200/70">Listado de órdenes en progreso.</p>
                        </a>
                        
                        <a href="{{ route('repairs.history') }}" wire:navigate class="block p-6 bg-yellow-900/30 border border-yellow-500/30 rounded-xl hover:bg-yellow-800/50 hover:border-yellow-400/50 hover:shadow-[0_0_15px_rgba(234,179,8,0.5)] transition-all duration-300">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-yellow-300">Histórico</h5>
                            <p class="font-normal text-yellow-200/70">Órdenes reparadas, entregadas o no reparables.</p>
                        </a>

                        <a href="{{ route('sales.index') }}" wire:navigate class="block p-6 bg-emerald-900/30 border border-emerald-500/30 rounded-xl hover:bg-emerald-800/50 hover:border-emerald-400/50 hover:shadow-[0_0_15px_rgba(16,185,129,0.5)] transition-all duration-300">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-emerald-300">Ventas y Stock</h5>
                            <p class="font-normal text-emerald-200/70">Gestión de compra, reparación y reventa.</p>
                        </a>

                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('users.index') }}" wire:navigate class="block p-6 bg-purple-900/30 border border-purple-500/30 rounded-xl hover:bg-purple-800/50 hover:border-purple-400/50 hover:shadow-[0_0_15px_rgba(168,85,247,0.5)] transition-all duration-300">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-purple-300">Técnicos</h5>
                                <p class="font-normal text-purple-200/70">Gestionar usuarios del sistema.</p>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
