@props(['value'])
<h2 {{$attributes->merge(['class' => 'font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4' ])}}>
    {{ $value ?? $slot }}
</h2>