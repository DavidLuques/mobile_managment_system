<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Inventario de Ventas') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('sales.history') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow-sm inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Histórico y Ganancias
                </a>
                <a href="{{ route('sales.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-sm inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Nuevo Equipo
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session()->has('message'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <!-- Buscador -->
                <div class="mb-4">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar por marca o modelo..." class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full sm:w-1/3">
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 bg-gray-50 border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-4">ID</th>
                                <th scope="col" class="px-6 py-4">Equipo</th>
                                <th scope="col" class="px-6 py-4">Precio Venta</th>
                                <th scope="col" class="px-6 py-4">Estado</th>
                                <th scope="col" class="px-6 py-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($phones as $phone)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">#{{ $phone->id }}</td>
                                    <td class="px-6 py-4">{{ $phone->brand }} {{ $phone->model }}</td>
                                    <td class="px-6 py-4 text-green-700 font-bold">${{ number_format($phone->sale_price, 2) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($phone->status == 'en_preparacion') bg-yellow-100 text-yellow-800 
                                            @elseif($phone->status == 'en_venta') bg-green-100 text-green-800 
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $phone->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm space-x-2">
                                        <a href="{{ route('sales.show', $phone->id) }}" class="text-blue-600 hover:text-blue-900">
                                            Ver
                                        </a>
                                        <a href="{{ route('sales.edit', $phone->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-2">
                                            Editar
                                        </a>
                                        <button wire:click="deletePhone({{ $phone->id }})" wire:confirm="¿Estás seguro de eliminar este equipo de tu inventario?" class="text-red-600 hover:text-red-900 ml-2">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No hay equipos en inventario de venta.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $phones->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
