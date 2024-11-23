@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-lime-600 dark:text-lime-400 text-center']) }}>
        {{ $status }}
    </div>
@endif
