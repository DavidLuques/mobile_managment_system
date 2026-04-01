<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Reparaciones') }}
            </h2>
            <a href="{{ route('repairs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Nueva Orden
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session()->has('message'))
                <div class="p-4 mb-4 text-sm text-green-200 border border-green-500/30 rounded-lg bg-green-900/30 backdrop-blur-md" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl sm:rounded-lg">
                <div class="mb-4">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar por cliente o equipo..." class="bg-gray-900/50 border-gray-700 text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full sm:w-1/3 placeholder-gray-500">
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm whitespace-nowrap text-gray-300">
                        <thead class="uppercase tracking-wider border-b-2 bg-gray-900/50 border-gray-700 text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-4">ID</th>
                                <th scope="col" class="px-6 py-4">Cliente</th>
                                <th scope="col" class="px-6 py-4">Equipo</th>
                                <th scope="col" class="px-6 py-4">Estado</th>
                                <th scope="col" class="px-6 py-4">Fecha Ingreso</th>
                                <th scope="col" class="px-6 py-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($repairs as $repair)
                                <tr class="border-b border-gray-700 hover:bg-gray-700/30 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-100">#{{ $repair->id }}</td>
                                    <td class="px-6 py-4 text-gray-300">{{ $repair->customer_name }}</td>
                                    <td class="px-6 py-4 text-gray-300">{{ $repair->phone_brand }} {{ $repair->phone_model }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border
                                            @if($repair->status == 'pendiente') bg-yellow-900/30 text-yellow-300 border-yellow-500/30
                                            @elseif($repair->status == 'en_reparacion') bg-blue-900/30 text-blue-300 border-blue-500/30
                                            @elseif($repair->status == 'reparado') bg-green-900/30 text-green-300 border-green-500/30
                                            @elseif($repair->status == 'no_reparable') bg-red-900/30 text-red-300 border-red-500/30
                                            @else bg-gray-900/30 text-gray-300 border-gray-500/30 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $repair->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400">{{ $repair->entrada_date->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 text-right text-sm space-x-3">
                                        <a href="{{ route('repairs.show', $repair->id) }}" class="inline-block text-blue-400 hover:text-blue-300 transition-colors group" title="Ver Detalles">
                                            <svg class="w-5 h-5 drop-shadow-[0_0_8px_rgba(59,130,246,0)] group-hover:drop-shadow-[0_0_8px_rgba(59,130,246,0.8)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        <a href="{{ route('repairs.edit', $repair->id) }}" class="inline-block text-indigo-400 hover:text-indigo-300 transition-colors group" title="Editar">
                                            <svg class="w-5 h-5 drop-shadow-[0_0_8px_rgba(99,102,241,0)] group-hover:drop-shadow-[0_0_8px_rgba(99,102,241,0.8)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <a href="{{ route('repairs.invoice', $repair->id) }}" target="_blank" class="inline-block text-green-400 hover:text-green-300 transition-colors group" title="Factura PDF">
                                            <svg class="w-5 h-5 drop-shadow-[0_0_8px_rgba(34,197,94,0)] group-hover:drop-shadow-[0_0_8px_rgba(34,197,94,0.8)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No hay órdenes de reparación.
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
