@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-stone-300 dark:border-stone-700 dark:bg-stone-900 dark:text-stone-300 rounded-md shadow-sm']) !!}>
