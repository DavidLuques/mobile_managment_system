<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ $phone && $phone->exists ? __('Editar Equipo #'.$phone->id) : __('Nueva Compra de Equipo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl sm:rounded-lg">
                <form wire:submit.prevent="save" class="space-y-6">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Detalles del Equipo -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-100 border-b border-gray-700 pb-2">Información del Equipo</h3>
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
                                            bg-yellow-900/30 text-yellow-300 border-yellow-500/30
                                            peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-offset-gray-800 peer-checked:ring-yellow-400 peer-checked:bg-yellow-600/50 peer-checked:border-yellow-400 peer-checked:text-yellow-100 hover:bg-yellow-800/40 shadow-sm">
                                            En Preparación
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="status" wire:model="status" value="en_venta" class="peer sr-only">
                                        <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                            bg-green-900/30 text-green-300 border-green-500/30
                                            peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-offset-gray-800 peer-checked:ring-green-400 peer-checked:bg-green-600/50 peer-checked:border-green-400 peer-checked:text-green-100 hover:bg-green-800/40 shadow-sm">
                                            En Venta
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="status" wire:model="status" value="vendido" class="peer sr-only">
                                        <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                            bg-gray-900/30 text-gray-300 border-gray-500/30
                                            peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-offset-gray-800 peer-checked:ring-gray-400 peer-checked:bg-gray-600/50 peer-checked:border-gray-400 peer-checked:text-gray-100 hover:bg-gray-800/40 shadow-sm">
                                            Vendido
                                        </div>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Costos y Reparación -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-100 border-b border-gray-700 pb-2">Contabilidad y Reparación</h3>
                            
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
                                <textarea wire:model="repair_description" id="repair_description" class="bg-gray-900/50 border-gray-700 text-gray-100 placeholder-gray-500 focus:border-fuchsia-500 focus:ring-fuchsia-500 rounded-md shadow-sm block mt-1 w-full" rows="2"></textarea>
                                <x-input-error :messages="$errors->get('repair_description')" class="mt-2" />
                            </div>

                            <div class="pt-2 border-t border-gray-700 mt-4">
                                <x-input-label for="sale_price" :value="__('Precio de Venta (Final) ($) *')" class="font-bold text-lg" />
                                <p class="text-xs text-gray-400 mb-2">Ajusta este precio al monto real en el que se vendió.</p>
                                <x-text-input wire:model="sale_price" id="sale_price" class="block mt-1 w-full text-lg font-bold text-green-400" type="number" step="0.01" required />
                                <x-input-error :messages="$errors->get('sale_price')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Evidencia Visual (Carga de Fotos) -->
                    <div class="mt-6 pt-4 border-t border-gray-700">
                        <h3 class="text-lg font-medium text-gray-100 mb-2">Fotos del Equipo</h3>
                        <p class="text-sm text-gray-400 mb-4">Sube fotos del equipo para mostrar el estado en el que se encuentra (Máx 5).</p>
                        
                        <div>
                            <x-input-label for="photos" :value="__('Seleccionar Fotos (Opcional)')" />
                            <input type="file" wire:model="photos" id="photos" multiple accept="image/*" class="mt-1 block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border file:border-gray-600 file:text-sm file:font-semibold file:bg-fuchsia-900/50 file:text-fuchsia-300 hover:file:bg-fuchsia-800/50" />
                            <x-input-error :messages="$errors->get('photos')" class="mt-2" />
                            @foreach($errors->get('photos.*') as $key => $messages)
                                <x-input-error :messages="$messages" class="mt-2" />
                            @endforeach
                        </div>

                        <div wire:loading wire:target="photos" class="mt-2 text-sm text-fuchsia-400">Cargando previsualización...</div>

                        @if(count($existing_images) > 0)
                        <div class="mt-4">
                            <span class="block text-sm font-medium text-gray-300 mb-2">Fotos guardadas:</span>
                            <div class="flex flex-wrap gap-2">
                                @foreach($existing_images as $key => $img)
                                    <div class="group relative w-24 h-24 border border-gray-700 rounded overflow-hidden">
                                        <img src="{{ Storage::url($img) }}" class="object-cover w-full h-full" alt="Evidencia">
                                        <button type="button" wire:click="removeExistingImage({{ $key }})" class="absolute top-1 right-1 bg-red-600/80 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-all drop-shadow-md hover:bg-red-500" title="Eliminar foto">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if($photos)
                        <div class="mt-4">
                            <span class="block text-sm font-medium text-gray-300 mb-2">Fotos listas para guardar:</span>
                            <div class="flex flex-wrap gap-2">
                                @foreach($photos as $key => $photo)
                                    <div class="group relative w-24 h-24 border rounded border-fuchsia-300 overflow-hidden">
                                        <img src="{{ $photo->temporaryUrl() }}" class="object-cover w-full h-full" alt="Preview">
                                        <button type="button" wire:click="removePhoto({{ $key }})" class="absolute top-1 right-1 bg-red-600/80 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-all drop-shadow-md hover:bg-red-500" title="Quitar foto">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-700">
                        <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                        <a href="{{ route('sales.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-700/50 border border-gray-600 rounded-md font-semibold text-xs text-gray-200 uppercase tracking-widest shadow-sm hover:bg-gray-600/80 transition-all">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
