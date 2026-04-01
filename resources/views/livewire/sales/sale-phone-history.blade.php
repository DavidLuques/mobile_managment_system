<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Historial de Ventas') }}
            </h2>
            <a href="{{ route('sales.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Volver al Inventario
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Dashboard Mensual -->
            <div class="grid grid-cols-1 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-indigo-500">
                    <div class="p-6 text-gray-900 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Ganancia Neta ({{ $currentMonthName }})</p>
                            <h3 class="text-3xl font-bold text-indigo-700 mt-1">
                                ${{ number_format($monthlyProfit, 2) }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-2">Calculado como: (Precio de Venta) - (Costo Compra + Repuestos) para equipos vendidos este mes.</p>
                        </div>
                        <div class="hidden sm:block">
                            <svg class="w-12 h-12 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <!-- Buscador -->
                <div class="mb-4">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar por marca o modelo..." class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full sm:w-1/3">
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 bg-gray-50 border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-4">Equipo</th>
                                <th scope="col" class="px-6 py-4">Inversión (C+R)</th>
                                <th scope="col" class="px-6 py-4">Venta Final</th>
                                <th scope="col" class="px-6 py-4 text-green-700 font-bold">Ganancia</th>
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
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $phone->brand }} {{ $phone->model }}</td>
                                    <td class="px-6 py-4 text-gray-500">
                                        <span title="Costo Compra: ${{ $phone->purchase_price }} + Costo Repuestos: ${{ $phone->repair_cost }}">
                                        ${{ number_format($inversion, 2) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900">${{ number_format($phone->sale_price, 2) }}</td>
                                    <td class="px-6 py-4 font-bold {{ $ganancia >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        ${{ number_format($ganancia, 2) }}
                                    </td>
                                    <td class="px-6 py-4">{{ $phone->sold_at ? $phone->sold_at->format('d/m/Y') : 'N/A' }}</td>
                                    <td class="px-6 py-4 text-right text-sm space-x-2">
                                        <a href="{{ route('sales.show', $phone->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                            Ver Detalles
                                        </a>
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
