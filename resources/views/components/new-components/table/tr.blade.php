@props([
    'href' => null,
    'last' => false,
])

@php
    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }} @if($href) href="{{ $href }}" @endif data-role="tr" {{ $attributes->merge(['class' => ($last ? 'rounded-b-2xl' : 'border-borders border-b') . ' hover:bg-secondary-background grid items-center px-4 py-1 transition']) }}>
    {{ $slot }}
</{{ $tag }}>
