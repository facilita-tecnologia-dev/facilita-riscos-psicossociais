@props([
    'href' => null,
    'activeRoute' => null, // pode ser string ou array
    'tooltip' => null,
    'tooltipPosition' => null,
    'icon' => null,
])

@php
    $tag = $href ? 'a' : 'button';

    // Normaliza activeRoute para array
    $activeRoutes = $activeRoute
        ? (is_array($activeRoute) ? $activeRoute : [$activeRoute])
        : [];

    // Verifica se **qualquer** rota está ativa
    $isActive = false;
    foreach ($activeRoutes as $routePattern) {
        if (request()->routeIs($routePattern)) {
            $isActive = true;
            break;
        }
    }

    // Define classes
    $activeClass = '';
    if ($isActive) {
        $isReportChannel = collect($activeRoutes)->contains(fn ($r) =>
            str_contains($r, 'report-channel')
        );

        $activeClass = ($isReportChannel
            ? 'bg-report-channel-primary-solid'
            : 'bg-primary-solid'
        ) . ' hover:brightness-95 text-main-background';
    } else {
        $activeClass = 'hover:bg-borders text-secondary-text border-borders border bg-transparent lg:border-0';
    }
@endphp

<{{ $tag }}
    @if ($href) href="{{ $href }}" @endif
    class="{{ $activeClass }} flex h-8 w-8 cursor-pointer items-center justify-center rounded-sm transition"
    @if ($tooltip) data-tippy-content="{{ $tooltip }}" @endif
    data-tippy-placement="{{ $tooltipPosition ?? 'right' }}"
    {{ $attributes }}
>
    <x-icon icon="{{ $icon }}" class="h-6 w-6 object-scale-down text-inherit" />
</{{ $tag }}>