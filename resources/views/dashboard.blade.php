<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold mb-4">Bienvenido, {{ auth()->user()->name }}</h3>
                    <p class="mb-4">Desde aquí puedes gestionar las reparaciones del local.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                        <a href="{{ route('repairs.create') }}" class="block p-6 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-blue-900">Nueva Orden</h5>
                            <p class="font-normal text-blue-700">Ingresar un nuevo equipo a reparación.</p>
                        </a>
                        
                        <a href="{{ route('repairs.index') }}" class="block p-6 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-green-900">Activas</h5>
                            <p class="font-normal text-green-700">Listado de órdenes en progreso.</p>
                        </a>
                        
                        <a href="{{ route('repairs.history') }}" class="block p-6 bg-yellow-50 border border-yellow-200 rounded-lg hover:bg-yellow-100 transition">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-yellow-900">Histórico</h5>
                            <p class="font-normal text-yellow-700">Órdenes reparadas, entregadas o no reparables.</p>
                        </a>

                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('users.index') }}" class="block p-6 bg-purple-50 border border-purple-200 rounded-lg hover:bg-purple-100 transition">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-purple-900">Técnicos</h5>
                                <p class="font-normal text-purple-700">Gestionar usuarios del sistema.</p>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
