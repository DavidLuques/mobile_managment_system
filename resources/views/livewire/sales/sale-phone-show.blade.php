<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles del Equipo #') . $phone->id }}
            </h2>
            <div class="space-x-2">
                @if($phone->status !== 'vendido')
                    <a href="{{ route('sales.edit', $phone->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-sm inline-flex items-center">
                        Editar Equipo
                    </a>
                @endif
                <a href="{{ $phone->status === 'vendido' ? route('sales.history') : route('sales.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow-sm inline-flex items-center">
                    Volver al Listado
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Información Principal -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">Información del Equipo</h3>
                        
                        <dl class="space-y-4 text-sm text-gray-600">
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="font-medium text-gray-900">Marca:</dt>
                                <dd class="col-span-2">{{ $phone->brand }}</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="font-medium text-gray-900">Modelo:</dt>
                                <dd class="col-span-2">{{ $phone->model }}</dd>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="font-medium text-gray-900">Estado:</dt>
                                <dd class="col-span-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($phone->status == 'en_preparacion') bg-yellow-100 text-yellow-800 
                                        @elseif($phone->status == 'en_venta') bg-green-100 text-green-800 
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $phone->status)) }}
                                    </span>
                                </dd>
                            </div>
                            @if($phone->status === 'vendido')
                            <div class="grid grid-cols-3 gap-4">
                                <dt class="font-medium text-gray-900">Fecha de Venta:</dt>
                                <dd class="col-span-2">{{ $phone->sold_at ? $phone->sold_at->format('d/m/Y H:i') : 'N/A' }}</dd>
                            </div>
                            @endif
                            <div class="grid grid-cols-3 gap-4 border-t pt-4">
                                <dt class="font-medium text-gray-900">Descripción Rep.:</dt>
                                <dd class="col-span-2">{{ $phone->repair_description ?: 'No se especificaron detalles de reparación.' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Contabilidad -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">Contabilidad</h3>
                        
                        <div class="bg-gray-50 rounded-lg p-4 space-y-3 shadow-inner">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Costo Base de Compra</span>
                                <span class="font-medium text-gray-900">${{ number_format($phone->purchase_price, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Costo de Repuestos</span>
                                <span class="font-medium text-gray-900">${{ number_format($phone->repair_cost, 2) }}</span>
                            </div>
                            <div class="pt-2 border-t border-gray-200 mt-2">
                                <div class="flex justify-between text-base">
                                    <span class="font-semibold text-gray-800">Inversión Total</span>
                                    <span class="font-bold text-gray-900">${{ number_format($phone->purchase_price + $phone->repair_cost, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                            <div class="flex justify-between text-lg">
                                <span class="font-bold text-gray-900">Precio de Venta</span>
                                <span class="font-bold text-green-700">${{ number_format($phone->sale_price, 2) }}</span>
                            </div>
                        </div>

                        @if($phone->status === 'vendido')
                            @php
                                $inversion = $phone->purchase_price + $phone->repair_cost;
                                $ganancia = $phone->sale_price - $inversion;
                            @endphp
                            <div class="mt-4 flex justify-between items-center p-4 rounded-lg {{ $ganancia >= 0 ? 'bg-green-100 text-green-900' : 'bg-red-100 text-red-900' }}">
                                <span class="font-bold">Ganancia Neta:</span>
                                <span class="font-extrabold text-xl">${{ number_format($ganancia, 2) }}</span>
                            </div>
                        @else
                            @php
                                $inversion = $phone->purchase_price + $phone->repair_cost;
                                $ganancia = $phone->sale_price - $inversion;
                            @endphp
                            <div class="mt-4 flex justify-between items-center p-4 rounded-lg bg-gray-100 text-gray-800">
                                <span class="font-medium text-sm">Ganancia Proyectada:</span>
                                <span class="font-bold">${{ number_format($ganancia, 2) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Evidencia Visual -->
                    @if($phone->images && count($phone->images) > 0)
                    <div class="md:col-span-2 pt-6 border-t mt-4">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Evidencia Visual (Fotos)</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                            @foreach($phone->images as $img)
                                <a href="{{ Storage::url($img) }}" target="_blank" class="block relative w-full pt-[100%] border rounded-lg overflow-hidden shadow-sm hover:opacity-75 transition-opacity">
                                    <img src="{{ Storage::url($img) }}" class="absolute inset-0 object-cover w-full h-full" alt="Evidencia">
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="md:col-span-2 pt-6 border-t mt-4 text-center">
                        <p class="text-sm text-gray-500">No hay fotografías registradas para este equipo.</p>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
