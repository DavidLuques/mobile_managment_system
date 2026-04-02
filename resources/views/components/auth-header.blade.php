@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center gap-1">
    <flux:heading size="xl" class="text-gray-100 font-bold tracking-tight">{{ $title }}</flux:heading>
    <flux:subheading class="text-gray-400">{{ $description }}</flux:subheading>
</div>
