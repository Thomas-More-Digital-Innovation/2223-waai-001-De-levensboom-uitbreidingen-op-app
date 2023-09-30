<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-wb-blue border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-wb-blue focus:bg-wb-blue active:bg-wb-blue focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
