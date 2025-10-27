@props([
    'fitSize' => false,
    'backgroundColor' => false,
    'href' => false,
    'slim' => false,
    'disabled' => false,
])

@php
    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }} @if($href) href="{{ $href }}" @endif @if($backgroundColor) style="background-color: {{ $backgroundColor }}" @endif {{ $attributes->merge(['class' => ($fitSize ? 'w-fit' : 'w-full') . ($slim ? ' h-[34px]' : ' h-[40px] md:h-[45px]') . ($disabled ? ' opacity-65' : ' opacity-100 hover:brightness-95 cursor-pointer') . ' bg-primary-solid flex  items-center justify-center gap-2 rounded-sm px-4 transition  ']) }} @if($disabled) disabled @endif>
    {{ $slot }}
</{{ $tag }}>
