<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $repair && $repair->exists ? __('Editar Orden de Reparación #'.$repair->id) : __('Nueva Orden de Reparación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form wire:submit.prevent="save" class="space-y-6">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Cliente Info -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Información del Cliente</h3>
                            <div>
                                <x-input-label for="customer_name" :value="__('Nombre Completo *')" />
                                <x-text-input wire:model="customer_name" id="customer_name" class="block mt-1 w-full" type="text" required />
                                <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="customer_phone" :value="__('Teléfono')" />
                                <x-text-input wire:model="customer_phone" id="customer_phone" class="block mt-1 w-full" type="text" />
                                <x-input-error :messages="$errors->get('customer_phone')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="customer_email" :value="__('Email')" />
                                <x-text-input wire:model="customer_email" id="customer_email" class="block mt-1 w-full" type="email" />
                                <x-input-error :messages="$errors->get('customer_email')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Equipo Info -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Información del Equipo</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="phone_brand" :value="__('Marca *')" />
                                    <x-text-input wire:model="phone_brand" id="phone_brand" class="block mt-1 w-full" type="text" required />
                                    <x-input-error :messages="$errors->get('phone_brand')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="phone_model" :value="__('Modelo *')" />
                                    <x-text-input wire:model="phone_model" id="phone_model" class="block mt-1 w-full" type="text" required />
                                    <x-input-error :messages="$errors->get('phone_model')" class="mt-2" />
                                </div>
                            </div>
                            <div>
                                <x-input-label for="phone_color" :value="__('Color')" />
                                <x-text-input wire:model="phone_color" id="phone_color" class="block mt-1 w-full" type="text" />
                                <x-input-error :messages="$errors->get('phone_color')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Reparación Info -->
                    <div class="space-y-4 mt-6">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Detalles de la Reparación</h3>
                        
                        <div>
                            <x-input-label for="problem_description" :value="__('Descripción del Problema *')" />
                            <textarea wire:model="problem_description" id="problem_description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" rows="3" required></textarea>
                            <x-input-error :messages="$errors->get('problem_description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label :value="__('Estado *')" class="mb-2" />
                            <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" wire:model="status" value="pendiente" class="peer sr-only">
                                    <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                        bg-yellow-50 text-yellow-800 border-yellow-200
                                        peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-yellow-500 peer-checked:bg-yellow-200 peer-checked:border-yellow-500
                                        hover:bg-yellow-100 shadow-sm">
                                        Pendiente
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" wire:model="status" value="en_reparacion" class="peer sr-only">
                                    <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                        bg-blue-50 text-blue-800 border-blue-200
                                        peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-blue-500 peer-checked:bg-blue-200 peer-checked:border-blue-500
                                        hover:bg-blue-100 shadow-sm">
                                        En Reparación
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" wire:model="status" value="reparado" class="peer sr-only">
                                    <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                        bg-green-50 text-green-800 border-green-200
                                        peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-green-500 peer-checked:bg-green-200 peer-checked:border-green-500
                                        hover:bg-green-100 shadow-sm">
                                        Reparado
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" wire:model="status" value="entregado" class="peer sr-only">
                                    <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                        bg-gray-100 text-gray-800 border-gray-300
                                        peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-gray-600 peer-checked:bg-gray-300 peer-checked:border-gray-600
                                        hover:bg-gray-200 shadow-sm">
                                        Entregado
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" wire:model="status" value="no_reparable" class="peer sr-only">
                                    <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                        bg-red-50 text-red-800 border-red-200
                                        peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-red-500 peer-checked:bg-red-200 peer-checked:border-red-500
                                        hover:bg-red-100 shadow-sm">
                                        No Reparable
                                    </div>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="repair_cost" :value="__('Costo de Reparación ($)')" />
                                <x-text-input wire:model="repair_cost" id="repair_cost" class="block mt-1 w-full" type="number" step="0.01" />
                                <x-input-error :messages="$errors->get('repair_cost')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="technical_notes" :value="__('Notas Técnicas (Internas)')" />
                            <textarea wire:model="technical_notes" id="technical_notes" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" rows="2"></textarea>
                            <x-input-error :messages="$errors->get('technical_notes')" class="mt-2" />
                        </div>
                        
                        <div>
                            <x-input-label for="observations" :value="__('Observaciones de Entrega')" />
                            <textarea wire:model="observations" id="observations" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" rows="2"></textarea>
                            <x-input-error :messages="$errors->get('observations')" class="mt-2" />
                        </div>
                        </div>
                        
                        <!-- Evidencia Visual (Carga de Fotos) -->
                        <div class="mt-6 pt-4 border-t">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Evidencia Visual (Fotos)</h3>
                            <p class="text-sm text-gray-500 mb-4">Sube fotos del equipo (Máx 5). Documenta el estado original del teléfono para prevenir reclamos.</p>
                            
                            <div>
                                <x-input-label for="photos" :value="__('Seleccionar Fotos')" />
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
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t">
                        <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                        <a href="{{ route('repairs.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
