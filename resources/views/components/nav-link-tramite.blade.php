@props(['active'])

@php
$classes = ($active ?? false)
? 'flex items-center space-x-2 py-1 font-semibold border-r-2 border-r-indigo-700 pr-20'
: 'flex items-center space-x-2 py-1 group hover:border-r-2 hover:border-r-indigo-700 hover:font-semibold';
@endphp

@php
$classesIcon = ($active ?? false)
? 'h-5 w-5 stroke-indigo-700'
: 'h-5 w-5 group-hover:stroke-indigo-700';
@endphp


<a {{ $attributes->merge(['class' => $classes]) }}>
    <svg {{ $attributes->merge(['class' => $classesIcon]) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
    </svg>
    <span>{{ $slot }}</span>
</a>