@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-gray-900/50 border-gray-700 text-gray-100 placeholder-gray-500 focus:border-fuchsia-500 focus:ring-fuchsia-500 rounded-md shadow-sm']) }}>
