<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles de Orden #'.$repair->id) }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('repairs.edit', $repair->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Editar
                </a>
                <a href="{{ route('repairs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Información del Cliente -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">Información del Cliente</h3>
                        <dl class="space-y-4 text-sm text-gray-600">
                            <div>
                                <dt class="font-semibold text-gray-900">Nombre Completo</dt>
                                <dd class="mt-1">{{ $repair->customer_name }}</dd>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <dt class="font-semibold text-gray-900">Teléfono</dt>
                                    <dd class="mt-1">{{ $repair->customer_phone ?? 'No registrado' }}</dd>
                                </div>
                                <div>
                                    <dt class="font-semibold text-gray-900">Email</dt>
                                    <dd class="mt-1">{{ $repair->customer_email ?? 'No registrado' }}</dd>
                                </div>
                            </div>
                        </dl>
                    </div>

                    <!-- Información del Equipo -->
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">Información del Equipo</h3>
                        <dl class="space-y-4 text-sm text-gray-600">
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <dt class="font-semibold text-gray-900">Marca</dt>
                                    <dd class="mt-1">{{ $repair->phone_brand }}</dd>
                                </div>
                                <div>
                                    <dt class="font-semibold text-gray-900">Modelo</dt>
                                    <dd class="mt-1">{{ $repair->phone_model }}</dd>
                                </div>
                                <div>
                                    <dt class="font-semibold text-gray-900">Color</dt>
                                    <dd class="mt-1">{{ $repair->phone_color ?? 'N/A' }}</dd>
                                </div>
                            </div>
                            <div>
                                <dt class="font-semibold text-gray-900">Descripción del Problema</dt>
                                <dd class="mt-1 p-3 bg-red-50 text-red-800 rounded-md border border-red-100">{{ $repair->problem_description }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Datos de Reparación -->
                    <div class="md:col-span-2 mt-4 pt-6 border-t">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Detalles y Estado de Reparación</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            
                            <dl class="space-y-4 text-sm text-gray-600">
                                <div>
                                    <dt class="font-semibold text-gray-900">Estado Actual</dt>
                                    <dd class="mt-1">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full 
                                            @if($repair->status == 'pendiente') bg-yellow-100 text-yellow-800 
                                            @elseif($repair->status == 'en_reparacion') bg-blue-100 text-blue-800 
                                            @elseif($repair->status == 'reparado') bg-green-100 text-green-800 
                                            @elseif($repair->status == 'no_reparable') bg-red-100 text-red-800 
                                            @else bg-gray-100 text-gray-800 @endif border">
                                            {{ strtoupper(str_replace('_', ' ', $repair->status)) }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="font-semibold text-gray-900">Costo de Reparación</dt>
                                    <dd class="mt-1 text-lg font-bold text-green-700">${{ number_format($repair->repair_cost, 2) }}</dd>
                                </div>
                            </dl>

                            <dl class="space-y-4 text-sm text-gray-600">
                                <div>
                                    <dt class="font-semibold text-gray-900">Fecha de Ingreso</dt>
                                    <dd class="mt-1">{{ $repair->entrada_date->format('d/m/Y H:i') }}</dd>
                                </div>
                                @if($repair->reparado_date)
                                <div>
                                    <dt class="font-semibold text-gray-900">Fecha Reparado</dt>
                                    <dd class="mt-1 text-green-700 font-semibold">{{ $repair->reparado_date->format('d/m/Y H:i') }}</dd>
                                </div>
                                @endif
                                <div>
                                    <dt class="font-semibold text-gray-900">Fecha de Egreso</dt>
                                    <dd class="mt-1">{{ $repair->salida_date ? $repair->salida_date->format('d/m/Y H:i') : 'Aún en taller' }}</dd>
                                </div>
                                @if($repair->status === 'entregado' && $repair->deliveredBy)
                                <div>
                                    <dt class="font-semibold text-gray-900">Entregado por</dt>
                                    <dd class="mt-1 text-gray-800">{{ $repair->deliveredBy->name }} ({{ $repair->deliveredBy->username }})</dd>
                                </div>
                                @endif
                            </dl>

                            <dl class="space-y-4 text-sm text-gray-600">
                                <div>
                                    <dt class="font-semibold text-gray-900">Notas Técnicas (Internas)</dt>
                                    <dd class="mt-1 p-3 bg-gray-50 rounded-md border text-gray-700 min-h-[3rem]">{{ $repair->technical_notes ?? 'Sin notas adicionales.' }}</dd>
                                </div>
                                <div>
                                    <dt class="font-semibold text-gray-900">Observaciones (Cliente)</dt>
                                    <dd class="mt-1 p-3 bg-gray-50 rounded-md border text-gray-700 min-h-[3rem]">{{ $repair->observations ?? 'Ninguna.' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    @if($repair->status === 'reparado' || $repair->status === 'entregado')
                        <div class="md:col-span-2 pt-4 flex justify-end">
                            <a href="{{ route('repairs.invoice', $repair->id) }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-sm inline-flex items-center">
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
