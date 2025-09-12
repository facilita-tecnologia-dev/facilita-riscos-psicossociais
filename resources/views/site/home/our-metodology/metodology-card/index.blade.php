<div class="swiper-slide w-full sm:!w-[372px] px-6 py-8 bg-main-background border-2 border-borders shadow-sm rounded-lg !flex flex-col gap-4">
    <h3 class="text-lg md:text-xl text-left text-main-text font-heading font-semibold">{{ $title }}</h3>
    
    <p class="text-sm text-left text-main-text leading-6 font-text font-normal">
        <span class="font-semibold">Requisitos Principais:</span> 
        {{ $mainRequirements }}
    </p>

    <p class="text-sm text-left text-main-text font-text font-normal">
        <span class="font-semibold">Cobertura:</span>
        {{ $coverage }}
    </p>

    @if(isset($coverageList))
        <div class="flex flex-col gap-3">
            <h4 class="text-sm text-left text-main-text font-heading font-semibold">O questionário cobre:</h4>
            <ul class="flex flex-col gap-3">
                @foreach($coverageList as $item)
                    <li class="flex items-center gap-2">
                        <x-icon icon="circle-check" class="w-4 h-4 object-scale-down text-primary-solid" />
                        <span class="text-sm text-left text-main-text font-text font-normal">{{ $item }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>