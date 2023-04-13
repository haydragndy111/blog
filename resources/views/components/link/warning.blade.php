@props(['active'])

@php
$classes = ($active ?? false)
? 'cursor-pointer inline-flex items-center px-1 pt-1 border-b-2 border-theme-yellow-100 font-medium leading-5 text-gray-900 focus:outline-none focus:border-theme-yellow-300 transition'
: 'cursor-pointer inline-flex items-center px-1 pt-1 border-b-2 border-transparent font-medium leading-5 text-gray-600 hover:text-theme-yellow-100 hover:border-theme-yellow-100 focus:outline-none focus:text-theme-yellow-100 focus:border-theme-yellow-100 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
