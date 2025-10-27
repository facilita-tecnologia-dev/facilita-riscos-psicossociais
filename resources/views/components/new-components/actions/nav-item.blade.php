@props([
    'route' => null,
    'activeRoute' => null,
    'tooltip' => null,
    'tooltipPosition' => null,
    'icon' => null,
])

<a 
    href="{{ $route }}" 
    class="flex items-center justify-center w-8 h-8 rounded-sm transition {{ $activeRoute && request()->routeIs($activeRoute) ? 'bg-primary-solid hover:brightness-95 text-main-background' : 'bg-transparent hover:bg-borders text-secondary-text' }}"
    @if($tooltip) data-tippy-content="{{ $tooltip }}" @endif 
    data-tippy-placement="{{ $tooltipPosition ?? 'right' }}"
>
    <x-icon icon="{{ $icon }}" class="w-6 h-6 object-scale-down text-inherit" />
</a>