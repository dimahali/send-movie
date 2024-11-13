<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-2 py-1.5 bg-red-50 border border-red-200 rounded-md font-semibold text-sm text-red-700 uppercase tracking-widest hover:bg-red-100 focus:bg-red-100 active:bg-red-100 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
