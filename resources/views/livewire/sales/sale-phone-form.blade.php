<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $phone && $phone->exists ? __('Editar Equipo #'.$phone->id) : __('Nueva Compra de Equipo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form wire:submit.prevent="save" class="space-y-6">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Detalles del Equipo -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Información del Equipo</h3>
                            <div>
                                <x-input-label for="brand" :value="__('Marca *')" />
                                <x-text-input wire:model="brand" id="brand" class="block mt-1 w-full" type="text" required />
                                <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="model" :value="__('Modelo *')" />
                                <x-text-input wire:model="model" id="model" class="block mt-1 w-full" type="text" required />
                                <x-input-error :messages="$errors->get('model')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label :value="__('Estado actual *')" class="mb-2" />
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="status" wire:model="status" value="en_preparacion" class="peer sr-only">
                                        <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                            bg-yellow-50 text-yellow-800 border-yellow-200
                                            peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-yellow-500 peer-checked:bg-yellow-200 peer-checked:border-yellow-500 hover:bg-yellow-100 shadow-sm">
                                            En Preparación
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="status" wire:model="status" value="en_venta" class="peer sr-only">
                                        <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                            bg-green-50 text-green-800 border-green-200
                                            peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-green-500 peer-checked:bg-green-200 peer-checked:border-green-500 hover:bg-green-100 shadow-sm">
                                            En Venta
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="status" wire:model="status" value="vendido" class="peer sr-only">
                                        <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                            bg-gray-100 text-gray-800 border-gray-300
                                            peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-gray-600 peer-checked:bg-gray-300 peer-checked:border-gray-600 hover:bg-gray-200 shadow-sm">
                                            Vendido
                                        </div>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Costos y Reparación -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Contabilidad y Reparación</h3>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="purchase_price" :value="__('Costo de Compra ($) *')" />
                                    <x-text-input wire:model="purchase_price" id="purchase_price" class="block mt-1 w-full" type="number" step="0.01" required />
                                    <x-input-error :messages="$errors->get('purchase_price')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="repair_cost" :value="__('Costo de Repuestos ($)')" />
                                    <x-text-input wire:model="repair_cost" id="repair_cost" class="block mt-1 w-full" type="number" step="0.01" />
                                    <x-input-error :messages="$errors->get('repair_cost')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="repair_description" :value="__('Descripción de Reparación (Qué se le hizo)')" />
                                <textarea wire:model="repair_description" id="repair_description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" rows="2"></textarea>
                                <x-input-error :messages="$errors->get('repair_description')" class="mt-2" />
                            </div>

                            <div class="pt-2 border-t mt-4">
                                <x-input-label for="sale_price" :value="__('Precio de Venta (Final) ($) *')" class="font-bold text-lg" />
                                <p class="text-xs text-gray-500 mb-2">Ajusta este precio al monto real en el que se vendió.</p>
                                <x-text-input wire:model="sale_price" id="sale_price" class="block mt-1 w-full text-lg font-bold text-green-700" type="number" step="0.01" required />
                                <x-input-error :messages="$errors->get('sale_price')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Evidencia Visual (Carga de Fotos) -->
                    <div class="mt-6 pt-4 border-t">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Fotos del Equipo</h3>
                        <p class="text-sm text-gray-500 mb-4">Sube fotos del equipo para mostrar el estado en el que se encuentra (Máx 5).</p>
                        
                        <div>
                            <x-input-label for="photos" :value="__('Seleccionar Fotos (Opcional)')" />
                            <input type="file" wire:model="photos" id="photos" multiple accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <x-input-error :messages="$errors->get('photos')" class="mt-2" />
                        </div>

                        <div wire:loading wire:target="photos" class="mt-2 text-sm text-indigo-600">Cargando previsualización...</div>

                        @if(count($existing_images) > 0)
                        <div class="mt-4">
                            <span class="block text-sm font-medium text-gray-700 mb-2">Fotos guardadas:</span>
                            <div class="flex flex-wrap gap-2">
                                @foreach($existing_images as $img)
                                    <div class="relative w-24 h-24 border rounded overflow-hidden">
                                        <img src="{{ Storage::url($img) }}" class="object-cover w-full h-full" alt="Evidencia">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if($photos)
                        <div class="mt-4">
                            <span class="block text-sm font-medium text-gray-700 mb-2">Fotos listas para guardar:</span>
                            <div class="flex flex-wrap gap-2">
                                @foreach($photos as $photo)
                                    <div class="relative w-24 h-24 border rounded border-indigo-300 overflow-hidden">
                                        <img src="{{ $photo->temporaryUrl() }}" class="object-cover w-full h-full" alt="Preview">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t">
                        <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                        <a href="{{ route('sales.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
