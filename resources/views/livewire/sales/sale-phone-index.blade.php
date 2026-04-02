<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Inventario de Ventas') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('sales.history') }}" wire:navigate class="bg-gray-700/80 hover:bg-gray-600/80 text-white font-bold py-2 px-4 rounded shadow-sm inline-flex items-center border border-gray-500/50 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Histórico y Ganancias
                </a>
                <a href="{{ route('sales.create') }}" wire:navigate class="bg-fuchsia-600/80 hover:bg-fuchsia-500/80 text-white font-bold py-2 px-4 rounded shadow-[0_0_15px_rgba(192,38,211,0.3)] inline-flex items-center border border-fuchsia-400/50 transition-all">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Nuevo Equipo
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session()->has('message'))
                <div class="p-4 mb-4 text-sm text-green-300 rounded-lg bg-green-900/30 border border-green-500/30" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl sm:rounded-lg">
                <!-- Buscador -->
                <div class="mb-4">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar por marca o modelo..." class="bg-gray-900/50 border-gray-700 text-gray-100 placeholder-gray-500 focus:border-fuchsia-500 focus:ring-fuchsia-500 rounded-md shadow-sm block w-full sm:w-1/3">
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 bg-gray-900/50 border-gray-700 text-gray-300">
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
                                <tr class="border-b border-gray-700 hover:bg-gray-700/50 text-gray-300 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-100">#{{ $phone->id }}</td>
                                    <td class="px-6 py-4">{{ $phone->brand }} {{ $phone->model }}</td>
                                    <td class="px-6 py-4 text-green-400 font-bold">${{ number_format($phone->sale_price, 2) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full border 
                                            @if($phone->status == 'en_preparacion') bg-yellow-900/30 text-yellow-300 border-yellow-500/30
                                            @elseif($phone->status == 'en_venta') bg-green-900/30 text-green-300 border-green-500/30
                                            @else bg-gray-900/30 text-gray-300 border-gray-500/30 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $phone->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm space-x-3">
                                        <a href="{{ route('sales.show', $phone->id) }}" wire:navigate class="inline-flex items-center text-blue-400 hover:text-blue-300 drop-shadow-[0_0_8px_rgba(96,165,250,0.5)] transition-all" title="Ver Detalles">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('sales.edit', $phone->id) }}" wire:navigate class="inline-flex items-center text-amber-400 hover:text-amber-300 drop-shadow-[0_0_8px_rgba(251,191,36,0.5)] transition-all" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.89 1.147l-3.141 1.047a.875.875 0 01-1.11-1.11l1.048-3.142a4.5 4.5 0 011.146-1.89l13.2-13.2z" />
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L16.875 4.5" />
                                            </svg>
                                        </a>
                                        <button wire:click="deletePhone({{ $phone->id }})" wire:confirm="¿Estás seguro de eliminar este equipo de tu inventario?" class="inline-flex items-center text-red-400 hover:text-red-300 drop-shadow-[0_0_8px_rgba(248,113,113,0.5)] transition-all" title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
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
