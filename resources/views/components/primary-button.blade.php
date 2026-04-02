<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-fuchsia-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-fuchsia-500 focus:bg-fuchsia-500 active:bg-fuchsia-700 focus:outline-none focus:ring-2 focus:ring-fuchsia-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-[0_0_10px_rgba(192,38,211,0.5)]']) }}>
    {{ $slot }}
</button>
