<div class="p-4 flex flex-col gap-4 rounded-lg bg-main-background border {{ isset($featured) && $featured ? 'border-primary-solid' : 'border-borders' }}">
    <header class="flex items-center justify-between">
        <h2 class="text-base md:text-lg text-left font-semibold text-main-text">{{ $title }}</h2>
        @if($tooltip)
            <div class="cursor-pointer transition hover:scale-105" data-tippy-content="{{ $tooltip }}">
                <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
            </div>
        @endif
    </header>

    @if(isset($main))
        <div class="flex items-center justify-between py-1 border-b border-borders">
            <span class="text-xs md:text-sm text-primary-solid font-semibold text-left">{{ $main['label'] }}</span>
            <span class="text-xs md:text-sm text-primary-solid font-semibold text-left">{{ $main['value'] }}</span>
        </div>
    @endif

    @if(isset($years) && count($years) > 0)
        <div class="space-y-2">
            @foreach ($years as $year => $value)            
                <div class="flex items-center justify-between">
                    <span class="text-xs md:text-sm text-main-text font-normal text-left">{{ $year }}</span>
                    <span class="text-xs md:text-sm text-secondary-text font-semibold text-left">{{ $value }}</span>
                </div>
            @endforeach
        </div>
    @endif
</div>