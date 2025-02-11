@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-4 border-slate-50 text-sm font-medium leading-5 text-slate-50 focus:outline-none focus:border-slate-300 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-sm font-medium leading-5 text-slate-50 hover:text-slate-300 hover:border-slate-300 focus:outline-none focus:text-slate-300 focus:border-slate-50 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
