<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Gestión de Técnicos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if (session()->has('message'))
                <div class="p-4 mb-4 text-sm text-green-300 rounded-lg bg-green-900/30 border border-green-500/30" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Form parameters -->
            <div class="p-4 sm:p-8 bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-100">
                        {{ __('Registrar Nuevo Técnico') }}
                    </h2>
                </header>
                <form wire:submit.prevent="createUser" class="mt-6 space-y-6">
                    <div>
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="username" :value="__('Usuario de acceso')" />
                        <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" required />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Contraseña')" />
                        <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Crear Técnico') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Table parameters -->
            <div class="p-4 sm:p-8 bg-gray-800/60 backdrop-blur-xl border border-white/10 shadow-2xl sm:rounded-lg">
                <header class="mb-6">
                    <h2 class="text-lg font-medium text-gray-100">
                        {{ __('Lista de Técnicos') }}
                    </h2>
                </header>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 bg-gray-900/50 border-gray-700 text-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-4">Nombre</th>
                                <th scope="col" class="px-6 py-4">Usuario</th>
                                <th scope="col" class="px-6 py-4">Email</th>
                                <th scope="col" class="px-6 py-4 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="border-b border-gray-700 text-gray-300 hover:bg-gray-700/50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-100">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->username }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-right text-sm">
                                        <button wire:click="deleteUser({{ $user->id }})" wire:confirm="¿Estás seguro de eliminar este técnico?" class="inline-flex items-center text-red-400 hover:text-red-300 drop-shadow-[0_0_8px_rgba(248,113,113,0.5)] transition-all" title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-400">
                                        No hay técnicos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
