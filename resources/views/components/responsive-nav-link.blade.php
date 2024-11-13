@props(['active'])
<a {{ $attributes->merge(['class' => '-mx-3 block rounded-lg px-3 py-2 text-base font-medium leading-7 text-slate-700 dark:text-slate-100 hover:bg-slate-50 dark:hover:bg-slate-950']) }}>
    {{ $slot }}
</a>
