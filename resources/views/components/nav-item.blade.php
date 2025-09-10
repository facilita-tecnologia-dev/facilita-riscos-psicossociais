@props([
    'href' => null,
    'route' => null,
    'label',
    'indicator' => null,
])

@php
    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }} @if($href) href="{{ $href }}" @endif class="relative flex-shrink-0 cursor-pointer" {{ $attributes }}>
    <span class="font-heading {{ $route && $href && request()->routeIs($route) ? 'text-primary-solid' : 'text-main-text' }} hover:text-primary-solid text-sm font-semibold transition md:text-base" aria-label="{{ $label }}">{{ $label }}</span>
    @if ($indicator)
        <div class="text-main-background bg-primary-solid absolute -top-2 -right-2 flex h-4 w-4 items-center justify-center rounded-full text-[10px]">{{ $indicator }}</div>
    @endif
</{{ $tag }}>
