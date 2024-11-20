@props(['active'])
<a {{ $attributes->merge(['class' => '-mx-3 block rounded-lg px-3 py-2 text-base font-medium leading-7 text-stone-700 dark:text-stone-100 hover:bg-stone-50 dark:hover:bg-stone-950']) }}>
    {{ $slot }}
</a>
