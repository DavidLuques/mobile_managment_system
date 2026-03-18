<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 bg-gray-50 border-gray-200">
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
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">#{{ $repair->id }}</td>
                                    <td class="px-6 py-4">{{ $repair->customer_name }}</td>
                                    <td class="px-6 py-4">{{ $repair->phone_brand }} {{ $repair->phone_model }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($repair->status == 'pendiente') bg-yellow-100 text-yellow-800 
                                            @elseif($repair->status == 'en_reparacion') bg-blue-100 text-blue-800 
                                            @elseif($repair->status == 'reparado') bg-green-100 text-green-800 
                                            @elseif($repair->status == 'no_reparable') bg-red-100 text-red-800 
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $repair->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $repair->entrada_date->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 text-right text-sm space-x-2">
                                        <a href="{{ route('repairs.show', $repair->id) }}" class="text-blue-600 hover:text-blue-900">
                                            Ver
                                        </a>
                                        <a href="{{ route('repairs.edit', $repair->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                            Editar
                                        </a>
                                        <a href="{{ route('repairs.invoice', $repair->id) }}" target="_blank" class="ml-2 text-green-600 hover:text-green-900">
                                            Factura (PDF)
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
