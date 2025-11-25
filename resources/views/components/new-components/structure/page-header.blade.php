@props([
    'icon',
    'label',
    'breadcrumbs' => null,
])

<header class="flex flex-col gap-3">
    <div class="flex items-center gap-2">
        <x-icon icon="{{ $icon }}" class="text-main-text h-6 w-6 object-scale-down" />
        <h1 class="text-main-text font-heading text-left text-2xl font-semibold">{{ $label }}</h1>
    </div>

    @if ($breadcrumbs)
        <x-new-components.structure.breadcrumbs :links="$breadcrumbs" />
    @endif
</header>
