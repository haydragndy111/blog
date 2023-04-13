<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-theme-red-100 border border-transparent rounded font-semibold text-xs text-white uppercase tracking-widest hover:bg-theme-red-200 active:bg-theme-red-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
