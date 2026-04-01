<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Detalles de Orden #' . $repair->id) }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('repairs.edit', $repair->id) }}" class="bg-indigo-600/80 hover:bg-indigo-500/80 shadow-[0_0_10px_rgba(79,70,229,0.3)] text-white font-bold py-2 px-4 rounded border border-indigo-400/50 transition-all">
                    Editar
                </a>
                <a href="{{ route('repairs.index') }}" class="bg-gray-600/80 hover:bg-gray-500/80 text-white font-bold py-2 px-4 rounded border border-gray-400/50 transition-all">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Información del Cliente -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-100 border-b border-gray-700 pb-2 mb-4">Información del Cliente</h3>
                        <dl class="space-y-4 text-sm text-gray-400">
                            <div>
                                <dt class="font-semibold text-gray-200">Nombre Completo</dt>
                                <dd class="mt-1">{{ $repair->customer_name }}</dd>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <dt class="font-semibold text-gray-200">Teléfono</dt>
                                    <dd class="mt-1">{{ $repair->customer_phone ?? 'No registrado' }}</dd>
                                </div>
                                <div>
                                    <dt class="font-semibold text-gray-200">Email</dt>
                                    <dd class="mt-1">{{ $repair->customer_email ?? 'No registrado' }}</dd>
                                </div>
                            </div>
                        </dl>
                    </div>

                    <!-- Información del Equipo -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-100 border-b border-gray-700 pb-2 mb-4">Información del Equipo</h3>
                        <dl class="space-y-4 text-sm text-gray-400">
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <dt class="font-semibold text-gray-200">Marca</dt>
                                    <dd class="mt-1">{{ $repair->phone_brand }}</dd>
                                </div>
                                <div>
                                    <dt class="font-semibold text-gray-200">Modelo</dt>
                                    <dd class="mt-1">{{ $repair->phone_model }}</dd>
                                </div>
                                <div>
                                    <dt class="font-semibold text-gray-200">Color</dt>
                                    <dd class="mt-1">{{ $repair->phone_color ?? 'N/A' }}</dd>
                                </div>
                            </div>
                            <div>
                                <dt class="font-semibold text-gray-200">Descripción del Problema</dt>
                                <dd class="mt-1 p-3 bg-red-900/30 text-red-300 rounded-md border border-red-500/30">{{ $repair->problem_description }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Datos de Reparación -->
                    <div class="md:col-span-2 mt-4 pt-6 border-t border-gray-700">
                        <h3 class="text-lg font-bold text-gray-100 mb-4">Detalles y Estado de Reparación</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            
                            <dl class="space-y-4 text-sm text-gray-400">
                                <div>
                                    <dt class="font-semibold text-gray-200">Estado Actual</dt>
                                    <dd class="mt-1">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full border
                                            @if($repair->status == 'pendiente') bg-yellow-900/30 text-yellow-300 border-yellow-500/30
                                            @elseif($repair->status == 'en_reparacion') bg-blue-900/30 text-blue-300 border-blue-500/30
                                            @elseif($repair->status == 'reparado') bg-green-900/30 text-green-300 border-green-500/30
                                            @elseif($repair->status == 'no_reparable') bg-red-900/30 text-red-300 border-red-500/30
                                            @else bg-gray-900/30 text-gray-300 border-gray-500/30 @endif">
                                            {{ strtoupper(str_replace('_', ' ', $repair->status)) }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="font-semibold text-gray-200">Costo de Reparación</dt>
                                    <dd class="mt-1 text-lg font-bold text-green-400">${{ number_format($repair->repair_cost, 2) }}</dd>
                                </div>
                            </dl>

                            <dl class="space-y-4 text-sm text-gray-400">
                                <div>
                                    <dt class="font-semibold text-gray-200">Fecha de Ingreso</dt>
                                    <dd class="mt-1">{{ $repair->entrada_date->format('d/m/Y H:i') }}</dd>
                                </div>
                                @if($repair->reparado_date)
                                <div>
                                    <dt class="font-semibold text-gray-200">Fecha Reparado</dt>
                                    <dd class="mt-1 text-green-400 font-semibold">{{ $repair->reparado_date->format('d/m/Y H:i') }}</dd>
                                </div>
                                @endif
                                <div>
                                    <dt class="font-semibold text-gray-200">Fecha de Egreso</dt>
                                    <dd class="mt-1">{{ $repair->salida_date ? $repair->salida_date->format('d/m/Y H:i') : 'Aún en taller' }}</dd>
                                </div>
                                @if($repair->status === 'entregado' && $repair->deliveredBy)
                                <div>
                                    <dt class="font-semibold text-gray-200">Entregado por</dt>
                                    <dd class="mt-1 text-gray-100">{{ $repair->deliveredBy->name }} ({{ $repair->deliveredBy->username }})</dd>
                                </div>
                                @endif
                            </dl>

                            <dl class="space-y-4 text-sm text-gray-400">
                                <div>
                                    <dt class="font-semibold text-gray-200">Notas Técnicas (Internas)</dt>
                                    <dd class="mt-1 p-3 bg-gray-900/50 rounded-md border border-gray-700 text-gray-300 min-h-[3rem]">{{ $repair->technical_notes ?? 'Sin notas adicionales.' }}</dd>
                                </div>
                                <div>
                                    <dt class="font-semibold text-gray-200">Observaciones (Cliente)</dt>
                                    <dd class="mt-1 p-3 bg-gray-900/50 rounded-md border border-gray-700 text-gray-300 min-h-[3rem]">{{ $repair->observations ?? 'Ninguna.' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    @if($repair->images && count($repair->images) > 0)
                    <!-- Evidencia Visual -->
                    <div class="md:col-span-2 pt-6 border-t border-gray-700">
                        <h3 class="text-lg font-bold text-gray-100 mb-4">Evidencia Visual (Fotos)</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                            @foreach($repair->images as $img)
                                <a href="{{ Storage::url($img) }}" target="_blank" class="block relative w-full pt-[100%] border border-gray-700 rounded-lg overflow-hidden shadow-sm hover:opacity-75 transition-opacity">
                                    <img src="{{ Storage::url($img) }}" class="absolute inset-0 object-cover w-full h-full" alt="Evidencia">
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($repair->status === 'reparado' || $repair->status === 'entregado')
                        <div class="md:col-span-2 pt-4 flex justify-end">
                            <a href="{{ route('repairs.invoice', $repair->id) }}" target="_blank" class="bg-green-600/80 hover:bg-green-500/80 shadow-[0_0_15px_rgba(34,197,94,0.3)] border border-green-400/50 text-white font-bold py-2 px-4 rounded transition-all inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Imprimir Factura PDF
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
