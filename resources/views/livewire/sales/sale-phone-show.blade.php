<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Detalles del Equipo #') . $phone->id }}
            </h2>
            <div class="space-x-2">
                @if($phone->status !== 'vendido')
                    <a href="{{ route('sales.edit', $phone->id) }}" class="bg-fuchsia-600/80 hover:bg-fuchsia-500/80 shadow-[0_0_10px_rgba(192,38,211,0.3)] text-white font-bold py-2 px-4 rounded border border-fuchsia-400/50 transition-all inline-flex items-center">
                        Editar Equipo
                    </a>
                @endif
                <a href="{{ $phone->status === 'vendido' ? route('sales.history') : route('sales.index') }}" class="bg-gray-700/80 hover:bg-gray-600/80 text-white font-bold py-2 px-4 rounded shadow-sm inline-flex items-center border border-gray-500/50 transition-all">
                    Volver al Listado
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Información Principal -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-100 border-b border-gray-700 pb-2 mb-4">Información del Equipo</h3>
                        
                        <dl class="space-y-4 text-sm text-gray-400">
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="font-medium text-gray-200">Marca:</dt>
                                <dd class="col-span-2">{{ $phone->brand }}</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="font-medium text-gray-200">Modelo:</dt>
                                <dd class="col-span-2">{{ $phone->model }}</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="font-medium text-gray-200">Estado:</dt>
                                <dd class="col-span-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full border
                                        @if($phone->status == 'en_preparacion') bg-yellow-900/30 text-yellow-300 border-yellow-500/30
                                        @elseif($phone->status == 'en_venta') bg-green-900/30 text-green-300 border-green-500/30
                                        @else bg-gray-900/30 text-gray-300 border-gray-500/30 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $phone->status)) }}
                                    </span>
                                </dd>
                            </div>
                            @if($phone->status === 'vendido')
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="font-medium text-gray-200">Fecha de Venta:</dt>
                                <dd class="col-span-2">{{ $phone->sold_at ? $phone->sold_at->format('d/m/Y H:i') : 'N/A' }}</dd>
                            </div>
                            @endif
                            <div class="grid grid-cols-3 gap-4 border-t border-gray-700 pt-4">
                                <dt class="font-medium text-gray-200">Descripción Rep.:</dt>
                                <dd class="col-span-2">{{ $phone->repair_description ?: 'No se especificaron detalles de reparación.' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Contabilidad -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-100 border-b border-gray-700 pb-2 mb-4">Contabilidad</h3>
                        
                        <div class="bg-gray-900/50 rounded-lg p-4 space-y-3 border border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Costo Base de Compra</span>
                                <span class="font-medium text-gray-200">${{ number_format($phone->purchase_price, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Costo de Repuestos</span>
                                <span class="font-medium text-gray-200">${{ number_format($phone->repair_cost, 2) }}</span>
                            </div>
                            <div class="pt-2 border-t border-gray-700 mt-2">
                                <div class="flex justify-between text-base">
                                    <span class="font-semibold text-gray-300">Inversión Total</span>
                                    <span class="font-bold text-gray-200">${{ number_format($phone->purchase_price + $phone->repair_cost, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 bg-gray-900/50 border border-gray-700 rounded-lg p-4 shadow-sm">
                            <div class="flex justify-between text-lg">
                                <span class="font-bold text-gray-200">Precio de Venta</span>
                                <span class="font-bold text-green-400">${{ number_format($phone->sale_price, 2) }}</span>
                            </div>
                        </div>

                        @if($phone->status === 'vendido')
                            @php
                                $inversion = $phone->purchase_price + $phone->repair_cost;
                                $ganancia = $phone->sale_price - $inversion;
                            @endphp
                            <div class="mt-4 flex justify-between items-center p-4 rounded-lg border {{ $ganancia >= 0 ? 'bg-green-900/30 text-green-300 border-green-500/30' : 'bg-red-900/30 text-red-300 border-red-500/30' }}">
                                <span class="font-bold">Ganancia Neta:</span>
                                <span class="font-extrabold text-xl">${{ number_format($ganancia, 2) }}</span>
                            </div>
                        @else
                            @php
                                $inversion = $phone->purchase_price + $phone->repair_cost;
                                $ganancia = $phone->sale_price - $inversion;
                            @endphp
                            <div class="mt-4 flex justify-between items-center p-4 rounded-lg border bg-gray-900/30 border-gray-500/30 text-gray-300">
                                <span class="font-medium text-sm">Ganancia Proyectada:</span>
                                <span class="font-bold text-fuchsia-400">${{ number_format($ganancia, 2) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Evidencia Visual -->
                    @if($phone->images && count($phone->images) > 0)
                    <div class="md:col-span-2 pt-6 border-t border-gray-700 mt-4">
                        <h3 class="text-lg font-bold text-gray-100 mb-4">Evidencia Visual (Fotos)</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                            @foreach($phone->images as $img)
                                <a href="{{ Storage::url($img) }}" target="_blank" class="block relative w-full pt-[100%] border border-gray-700 rounded-lg overflow-hidden shadow-sm hover:opacity-75 transition-opacity">
                                    <img src="{{ Storage::url($img) }}" class="absolute inset-0 object-cover w-full h-full" alt="Evidencia">
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="md:col-span-2 pt-6 border-t border-gray-700 mt-4 text-center">
                        <p class="text-sm text-gray-500">No hay fotografías registradas para este equipo.</p>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
