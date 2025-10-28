@props([
    'links' => [],
])

<nav aria-label="breadcrumb" class="hidden w-full md:block">
    <ul class="flex items-center gap-1">
        <x-icon icon="hash" class="w-4 h-4 object-scale-down text-secondary-text" />
        
        @foreach ($links as $label => $url)
            @if (!$loop->first)
                <x-icon icon="arrow-right" class="w-4 h-4 object-scale-down text-secondary-text" />
            @endif

            @if (!$url)
                <li>
                    <span class="text-sm text-secondary-text text-left font-normal">
                        {{ $label }}
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $url }}" class="text-sm text-secondary-text text-left font-semibold underline">
                        {{ $label }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</nav>
