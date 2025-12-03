<div class="border-borders bg-main-background flex max-h-[300px] grow-0 flex-col gap-6 rounded-lg border p-4">
    @php
        $engagementLevel = App\Enums\Psychosocial\EngagementLevel::fromPercentage($engagement['general']);
    @endphp

    <header class="flex items-center justify-between">
        <h2 class="text-main-text font-heading text-left text-lg font-semibold">Participação</h2>

        <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Neste card, você pode visualizar a adesão da sua campanha de testes, dividida por setor ou por função.">
            <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
        </div>
    </header>

    <div id="percentage" class="space-y-1.5">
        <header class="flex items-center justify-between">
            <span style="color: {{ $engagementLevel->color() }}" class="font-heading text-left text-sm font-semibold">Adesão {{ $engagementLevel->value }}</span>
            <span style="color: {{ $engagementLevel->color() }}" class="font-heading text-right text-sm font-semibold">{{ $engagement['general'] }}%</span>
        </header>

        <div class="bg-borders h-1 w-full rounded-full">
            <div style="background-color: {{ $engagementLevel->color() }}; width: {{ $engagement['general'] }}%" class="h-full rounded-full"></div>
        </div>
    </div>

    <div class="flex flex-1 flex-col gap-2 overflow-y-auto pr-2">
        @foreach ($engagement['divided'] as $itemName => $itemEngagement)
            @php
                $departmentEngagementLevel = App\Enums\Psychosocial\EngagementLevel::fromPercentage($itemEngagement['engagement']);
            @endphp

            <div class="flex items-center justify-between">
                <span class="text-main-text font-heading text-left text-sm font-normal">{{ $itemName }}</span>
                <span style="color: {{ $departmentEngagementLevel->color() }}" class="font-heading text-left text-sm font-semibold">{{ $itemEngagement['engagement'] }}%</span>
            </div>
        @endforeach
    </div>
</div>
