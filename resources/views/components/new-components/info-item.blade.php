@props([
    'label',
    'value',
    'truncate' => false,
])

<div class="flex w-full flex-col gap-1">
    <h3 class="font-heading text-main-text {{ $truncate ? 'truncate' : 'break-words' }} w-full text-left text-sm font-normal" title="{{ $label }}">{{ $label }}</h3>
    <span class="font-heading text-main-text {{ $truncate ? 'truncate' : 'break-words' }} w-full text-left text-base font-semibold" title="{{ $value }}">{{ $value }}</span>
</div>
