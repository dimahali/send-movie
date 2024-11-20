@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-1 pt-1 border-b-2 border-red-400 dark:border-red-600 text-sm font-medium leading-5 text-stone-700 dark:text-stone-100 focus:outline-none focus:border-red-700 transition duration-150 ease-in-out'
                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-stone-500 dark:text-stone-300 hover:text-stone-700 dark:hover:text-stone-300 hover:border-stone-300 dark:hover:border-stone-700 focus:outline-none focus:text-stone-700 dark:focus:text-stone-300 focus:border-stone-300 dark:focus:border-stone-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
