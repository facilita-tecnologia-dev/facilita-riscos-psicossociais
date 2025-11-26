@props([
    'href' => null,
    'activeRoute' => null,
    'tooltip' => null,
    'tooltipPosition' => null,
    'icon' => null,
])

@php
    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }} @if($href) href="{{ $href }}" @endif class="{{ $activeRoute && request()->routeIs($activeRoute) ? (str_contains($activeRoute, 'report-channel') ? 'bg-report-channel-primary-solid' : 'bg-primary-solid') . ' hover:brightness-95 text-main-background' : 'hover:bg-borders text-secondary-text border-borders border bg-transparent lg:border-0' }} flex h-8 w-8 cursor-pointer items-center justify-center rounded-sm transition" @if($tooltip) data-tippy-content="{{ $tooltip }}" @endif data-tippy-placement="{{ $tooltipPosition ?? 'right' }}">
    <x-icon icon="{{ $icon }}" class="h-6 w-6 object-scale-down text-inherit" />
</{{ $tag }}>
