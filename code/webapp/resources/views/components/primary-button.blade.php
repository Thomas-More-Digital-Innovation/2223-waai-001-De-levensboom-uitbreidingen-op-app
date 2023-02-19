<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#3c8dbc] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0073b7] focus:bg-[#0073b7] active:bg-[#0073b7] focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
