<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ $repair && $repair->exists ? __('Editar Orden de Reparación #'.$repair->id) : __('Nueva Orden de Reparación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl sm:rounded-lg">
                @if (session()->has('message'))
                    <div class="p-4 mb-4 text-sm text-green-300 rounded-lg bg-green-900/30 border border-green-500/30" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <form wire:submit.prevent="save" class="space-y-6">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Cliente Info -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-100 border-b border-gray-700 pb-2">Información del Cliente</h3>
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
                            <h3 class="text-lg font-medium text-gray-100 border-b border-gray-700 pb-2">Información del Equipo</h3>
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
                        <h3 class="text-lg font-medium text-gray-100 border-b border-gray-700 pb-2">Detalles de la Reparación</h3>
                        
                        <div>
                            <x-input-label for="problem_description" :value="__('Descripción del Problema *')" />
                            <textarea wire:model="problem_description" id="problem_description" class="bg-gray-900/50 border-gray-700 text-gray-100 focus:border-fuchsia-500 focus:ring-fuchsia-500 rounded-md shadow-sm block mt-1 w-full placeholder-gray-500" rows="3" required></textarea>
                            <x-input-error :messages="$errors->get('problem_description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label :value="__('Estado *')" class="mb-2" />
                            <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" wire:model="status" value="pendiente" class="peer sr-only">
                                    <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                        bg-yellow-900/30 text-yellow-300 border-yellow-500/30
                                        peer-checked:line-through peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-offset-gray-800 peer-checked:ring-yellow-400 peer-checked:bg-yellow-600/50 peer-checked:border-yellow-400 peer-checked:text-yellow-100
                                        hover:bg-yellow-800/40 shadow-sm">
                                        Pendiente
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" wire:model="status" value="en_reparacion" class="peer sr-only">
                                    <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                        bg-blue-900/30 text-blue-300 border-blue-500/30
                                        peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-offset-gray-800 peer-checked:ring-blue-400 peer-checked:bg-blue-600/50 peer-checked:border-blue-400 peer-checked:text-blue-100
                                        hover:bg-blue-800/40 shadow-sm">
                                        En Reparación
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" wire:model="status" value="reparado" class="peer sr-only">
                                    <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                        bg-green-900/30 text-green-300 border-green-500/30
                                        peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-offset-gray-800 peer-checked:ring-green-400 peer-checked:bg-green-600/50 peer-checked:border-green-400 peer-checked:text-green-100
                                        hover:bg-green-800/40 shadow-sm">
                                        Reparado
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" wire:model="status" value="entregado" class="peer sr-only">
                                    <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                        bg-gray-900/30 text-gray-300 border-gray-500/30
                                        peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-offset-gray-800 peer-checked:ring-gray-400 peer-checked:bg-gray-600/50 peer-checked:border-gray-400 peer-checked:text-gray-100
                                        hover:bg-gray-800/40 shadow-sm">
                                        Entregado
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" wire:model="status" value="no_reparable" class="peer sr-only">
                                    <div class="rounded-lg border px-4 py-2 text-center text-sm font-medium transition-all
                                        bg-red-900/30 text-red-300 border-red-500/30
                                        peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-offset-gray-800 peer-checked:ring-red-400 peer-checked:bg-red-600/50 peer-checked:border-red-400 peer-checked:text-red-100
                                        hover:bg-red-800/40 shadow-sm">
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
                            <textarea wire:model="technical_notes" id="technical_notes" class="bg-gray-900/50 border-gray-700 text-gray-100 focus:border-fuchsia-500 focus:ring-fuchsia-500 rounded-md shadow-sm block mt-1 w-full placeholder-gray-500" rows="2"></textarea>
                            <x-input-error :messages="$errors->get('technical_notes')" class="mt-2" />
                        </div>
                        
                        <div>
                            <x-input-label for="observations" :value="__('Observaciones de Entrega')" />
                            <textarea wire:model="observations" id="observations" class="bg-gray-900/50 border-gray-700 text-gray-100 focus:border-fuchsia-500 focus:ring-fuchsia-500 rounded-md shadow-sm block mt-1 w-full placeholder-gray-500" rows="2"></textarea>
                            <x-input-error :messages="$errors->get('observations')" class="mt-2" />
                        </div>
                        </div>
                        
                        <!-- Evidencia Visual (Carga de Fotos) -->
                        <div class="mt-6 pt-4 border-t border-gray-700">
                            <h3 class="text-lg font-medium text-gray-100 mb-2">Evidencia Visual (Fotos)</h3>
                            <p class="text-sm text-gray-400 mb-4">Sube fotos del equipo (Máx 5). Documenta el estado original del teléfono para prevenir reclamos.</p>
                            
                            <div>
                                <x-input-label for="photos" :value="__('Seleccionar Fotos')" />
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
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-gray-700">
                        <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                        <a href="{{ route('repairs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-700/50 border border-gray-600 rounded-md font-semibold text-xs text-gray-200 uppercase tracking-widest shadow-sm hover:bg-gray-600/80 transition-all">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
