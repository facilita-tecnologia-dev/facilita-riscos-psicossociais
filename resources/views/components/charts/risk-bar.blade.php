@props([
    'href',
    'hazard',
    'risk',
    'color',
])

<a href="{{ $href }}" class="block px-1.5 py-2 border border-transparent hover:border-gray-200 w-full space-y-1 relative left-0 top-0 hover:left-0.5 hover:-top-0.5 transition-all hover:shadow-md">
    @php
        $hazard = session('auth:company')->usesHSE() ? App\Enums\HSE\HSEHazard::from($hazard)->label() : App\Enums\PROART\PROARTHazard::from($hazard)->label();
    @endphp

    <p class="text-xs">{{ $hazard }}</p>

    <div data-role="risk-bar" data-value="{{ $risk->value }}" class="relative w-full h-6 border border-gray-800/50 rounded-md overflow-hidden">
        <div id="bar" data-color="{{ $risk->color() }}" class="w-0 transition-all duration-700 h-full"></div>
        <p class="text-xs absolute top-1/2 -translate-y-1/2 right-2 text-gray-800">{{ $risk->label() }}</p>
    </div>
</a>