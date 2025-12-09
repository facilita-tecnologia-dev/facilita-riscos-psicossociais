@props([
    'href' => null,
    'activeRoute' => null,
    'label' => null,
    'icon' => null,
])

<a @if($href) href="{{ $href }}" @endif class="{{ $activeRoute && request()->routeIs($activeRoute) ? (str_contains($activeRoute, 'report-channel') ? 'bg-report-channel-primary-solid' : 'bg-primary-solid') . ' hover:brightness-95 text-main-background' : 'hover:bg-borders text-secondary-text border-borders border bg-transparent lg:border-0' }} flex w-full items-center justify-start gap-2 rounded-sm px-3 py-2 transition" {{ $attributes }}>
    @if($icon)
        <x-icon icon="{{ $icon }}" class="h-5 w-5 object-scale-down text-inherit" />
    @endif
    <span class="{{ $activeRoute && request()->routeIs($activeRoute) ? 'text-main-background' : 'text-secondary-text' }} text-left font-normal">{{ $label }}</span>
</a>
