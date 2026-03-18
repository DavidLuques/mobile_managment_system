<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Histórico de Reparaciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session()->has('message'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Órdenes Finalizadas</h3>
                    <div class="w-1/3">
                        <input wire:model.live="search" type="text" placeholder="Buscar por ID, Cliente o Equipo..." 
                               class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 bg-gray-50 border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-4">ID</th>
                                <th scope="col" class="px-6 py-4">Cliente</th>
                                <th scope="col" class="px-6 py-4">Equipo</th>
                                <th scope="col" class="px-6 py-4">Estado</th>
                                <th scope="col" class="px-6 py-4">Fecha Reparado</th>
                                <th scope="col" class="px-6 py-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($repairs as $repair)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">#{{ $repair->id }}</td>
                                    <td class="px-6 py-4">{{ $repair->customer_name }}</td>
                                    <td class="px-6 py-4">{{ $repair->phone_brand }} {{ $repair->phone_model }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($repair->status == 'reparado') bg-green-100 text-green-800 
                                            @elseif($repair->status == 'no_reparable') bg-red-100 text-red-800 
                                            @else bg-gray-100 text-gray-800 @endif border border-gray-200">
                                            {{ strtoupper(str_replace('_', ' ', $repair->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $repair->reparado_date ? $repair->reparado_date->format('d/m/Y H:i') : 'N/A' }}</td>
                                    <td class="px-6 py-4 text-right text-sm flex justify-end space-x-3">
                                        <a href="{{ route('repairs.show', $repair->id) }}" class="text-blue-600 hover:text-blue-900" title="Ver">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('repairs.edit', $repair->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Editar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        <button wire:click="deleteRepair({{ $repair->id }})" wire:confirm="¿Desea eliminar este histórico?" class="text-red-600 hover:text-red-900" title="Borrar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                        @endif
                                        <a href="{{ route('repairs.invoice', $repair->id) }}" target="_blank" class="text-green-600 hover:text-green-900" title="PDF">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No hay órdenes en el historial (sólo se muestran las reparadas o finalizadas).
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $repairs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
