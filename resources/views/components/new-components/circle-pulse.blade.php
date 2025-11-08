@props([
    'color',
    'size',
    'tooltip' => null,
])

<span class="{{ $size }} relative mr-2 flex" @if($tooltip) data-tippy-content="{{ $tooltip }}" @endif>
    <span class="{{ $color }} absolute inline-flex h-full w-full animate-ping rounded-full opacity-75"></span>
    <span class="{{ $color }} {{ $size }} relative inline-flex rounded-full"></span>
</span>
