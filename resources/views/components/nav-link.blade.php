@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link text-white active bg-gradient-success'
            : 'nav-link text-white ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
