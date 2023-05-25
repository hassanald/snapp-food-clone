<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center mx-auto px-20 py-1 bg-pink-800 border border-transparent rounded-md font-semibold text-base text-white uppercase tracking-widest hover:bg-pink-700 focus:bg-pink-700 active:bg-pink-900 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
