@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-1 pt-1 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150'
: 'inline-flex items-center px-1 pt-1 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>