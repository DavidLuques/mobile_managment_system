<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Historial de Ventas') }}
            </h2>
            <a href="{{ route('sales.index') }}" class="bg-gray-700/80 hover:bg-gray-600/80 text-white font-bold py-2 px-4 rounded border border-gray-500/50 transition-all">
                Volver al Inventario
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Dashboard Mensual -->
            <div class="grid grid-cols-1 mb-6">
                <div class="bg-gray-800/60 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-lg border border-white/10 border-l-4 border-l-fuchsia-500 relative">
                    <div class="absolute -right-10 -top-10 bg-fuchsia-500/10 w-40 h-40 rounded-full blur-3xl"></div>
                    <div class="p-6 text-gray-100 flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-sm font-medium text-gray-400 uppercase tracking-wide">Ganancia Neta ({{ $currentMonthName }})</p>
                            <h3 class="text-3xl font-bold text-fuchsia-400 mt-1 shadow-fuchsia-500/20 drop-shadow-md">
                                ${{ number_format($monthlyProfit, 2) }}
                            </h3>
                            <p class="text-xs text-gray-500 mt-2">Calculado como: (Precio de Venta) - (Costo Compra + Repuestos) para equipos vendidos este mes.</p>
                        </div>
                        <div class="hidden sm:block">
                            <svg class="w-12 h-12 text-fuchsia-500/50 drop-shadow-[0_0_10px_rgba(217,70,239,0.5)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl sm:rounded-lg">
                <!-- Buscador -->
                <div class="mb-4">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar por marca o modelo..." class="bg-gray-900/50 border-gray-700 text-gray-100 placeholder-gray-500 focus:border-fuchsia-500 focus:ring-fuchsia-500 rounded-md shadow-sm block w-full sm:w-1/3">
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 bg-gray-900/50 border-gray-700 text-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-4">Equipo</th>
                                <th scope="col" class="px-6 py-4">Inversión (C+R)</th>
                                <th scope="col" class="px-6 py-4">Venta Final</th>
                                <th scope="col" class="px-6 py-4 text-green-400 font-bold">Ganancia</th>
                                <th scope="col" class="px-6 py-4">Fecha Venta</th>
                                <th scope="col" class="px-6 py-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($phones as $phone)
                                @php
                                    $inversion = $phone->purchase_price + $phone->repair_cost;
                                    $ganancia = $phone->sale_price - $inversion;
                                @endphp
                                <tr class="border-b border-gray-700 hover:bg-gray-700/50 text-gray-300 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-100">{{ $phone->brand }} {{ $phone->model }}</td>
                                    <td class="px-6 py-4 text-gray-400">
                                        <span title="Costo Compra: ${{ $phone->purchase_price }} + Costo Repuestos: ${{ $phone->repair_cost }}">
                                        ${{ number_format($inversion, 2) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-100">${{ number_format($phone->sale_price, 2) }}</td>
                                    <td class="px-6 py-4 font-bold {{ $ganancia >= 0 ? 'text-green-400' : 'text-red-400' }}">
                                        ${{ number_format($ganancia, 2) }}
                                    </td>
                                    <td class="px-6 py-4">{{ $phone->sold_at ? $phone->sold_at->format('d/m/Y') : 'N/A' }}</td>
                                    <td class="px-6 py-4 text-right text-sm space-x-2">
                                        <a href="{{ route('sales.show', $phone->id) }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 drop-shadow-[0_0_8px_rgba(96,165,250,0.5)] transition-all" title="Ver Detalles">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('sales.edit', $phone->id) }}" class="inline-flex items-center text-amber-400 hover:text-amber-300 drop-shadow-[0_0_8px_rgba(251,191,36,0.5)] transition-all" title="Editar">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.89 1.147l-3.141 1.047a.875.875 0 01-1.11-1.11l1.048-3.142a4.5 4.5 0 011.146-1.89l13.2-13.2z" />
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L16.875 4.5" />
                                                </svg>
                                            </a>
                                            <button wire:click="deletePhone({{ $phone->id }})" 
                                                wire:confirm="¿Estás seguro de que deseas eliminar este registro de venta? Esta acción no se puede deshacer."
                                                class="inline-flex items-center text-red-500 hover:text-red-400 drop-shadow-[0_0_8px_rgba(239,68,68,0.5)] transition-all" 
                                                title="Eliminar">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No hay registros de ventas que coincidan.
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
