<div class="contents">
    <x-structure.page-header icon="calendar-clock" label="Lista de Campanhas" :breadcrumbs="['Lista de Campanhas' => null]" />

    @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('create', [\App\Models\Campaign::class]))
        <div>
            <x-actions.button :href="route('campaign.create')">
                <span class="text-main-background text-center text-sm font-semibold">Agendar nova campanha</span>
            </x-actions.button>
        </div>
    @endif

    <section id="campaign-list" class="space-y-8">
        <div id="current-year-campaigns" class="space-y-4">
            <h2 class="text-xl text-left font-semibold text-main-text">Campanhas - {{ now()->year }}</h2>

            @if ($currentYearCampaigns && $currentYearCampaigns->count())
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 items-start">
                    @foreach ($currentYearCampaigns as $campaign)
                        <div class="p-6 rounded-2xl bg-secondary-background border border-borders shadow-sm flex flex-col gap-4">
                            <header class="flex justify-between items-start">
                                <div class="w-14 h-14 bg-primary-solid rounded-full flex items-center justify-center">
                                    @if($campaign->collection()->type === App\Enums\Campaign\CollectionType::PSYCHOSOCIAL)
                                        <x-icon icon="brain" class="text-main-background h-6 w-6 object-scale-down" />
                                    @else
                                        <x-icon icon="cloud" class="text-main-background h-6 w-6 object-scale-down" />
                                    @endif
                                </div>

                                <div class="flex items-center gap-2">
                                    <div style="background-color: {{ $campaign->status->color() }}" class="w-2 h-2 rounded-full"></div>
                                    <span class="text-main-text text-left text-xs font-normal">{{ $campaign->status->label() }}</span>
                                </div>
                            </header>

                            <div class="flex flex-col gap-2">
                                <x-info-item label="Nome da Campanha" :value="$campaign->name" truncate />
                                <x-info-item label="Data" value="{{ $campaign->start_date->format('d/m/Y') . ' - ' . $campaign->end_date->format('d/m/Y') }}" truncate />
                                <x-info-item label="Descrição" :value="$campaign->description ?? 'Sem descrição'" truncate />
                            </div>

                            @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('edit', [\App\Models\Campaign::class, $campaign]) && ($campaign->status !== App\Enums\Campaign\CampaignStatus::COMPLETED || !$campaign->end_date->lt(now())))
                                <x-actions.button :href="route('campaign.edit', $campaign)">
                                    <span class="text-main-background text-center text-sm font-semibold">Editar</span>
                                </x-actions.button>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex w-full">
                    <p class="text-secondary-text font-heading text-center text-sm font-normal sm:text-base">Você ainda não agendou nenhuma campanha no ano atual.</p>
                </div>
            @endif
        </div>

        <div id="previous-year-campaigns" class="space-y-4">
            <h2 class="text-xl text-left font-semibold text-main-text">Campanhas Anteriores</h2>

            @if ($previousYearCampaigns && $previousYearCampaigns->count())
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 items-start">
                    @foreach ($previousYearCampaigns as $campaign)
                        <div class="p-6 rounded-2xl bg-secondary-background border border-borders shadow-sm flex flex-col gap-4">
                            <header class="flex justify-between items-start">
                                <div class="w-14 h-14 bg-primary-solid rounded-full flex items-center justify-center">
                                    @if($campaign->collection()->type === App\Enums\Campaign\CollectionType::PSYCHOSOCIAL)
                                        <x-icon icon="brain" class="text-main-background h-6 w-6 object-scale-down" />
                                    @else
                                        <x-icon icon="cloud" class="text-main-background h-6 w-6 object-scale-down" />
                                    @endif
                                </div>

                                <div class="flex items-center gap-2">
                                    <div style="background-color: {{ $campaign->status->color() }}" class="w-2 h-2 rounded-full"></div>
                                    <span class="text-main-text text-left text-xs font-normal">{{ $campaign->status->label() }}</span>
                                </div>
                            </header>

                            <div class="flex flex-col gap-2">
                                <x-info-item label="Nome da Campanha" :value="$campaign->name" truncate />
                                <x-info-item label="Data" value="{{ $campaign->start_date->format('d/m/Y') . ' - ' . $campaign->end_date->format('d/m/Y') }}" truncate />
                                <x-info-item label="Descrição" :value="$campaign->description ?? 'Sem descrição'" truncate />
                            </div>

                            <x-actions.button :href="$campaign->collection()->type === App\Enums\Campaign\CollectionType::PSYCHOSOCIAL ? route('psychosocial.dashboard', $campaign) : route('organizational.dashboard', $campaign)">
                                <span class="text-main-background text-center text-sm font-semibold">Visualizar resultados</span>
                            </x-actions.button>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex w-full">
                    <p class="text-secondary-text font-heading text-center text-sm font-normal sm:text-base">A empresa não tem campanhas anteriores</p>
                </div>
            @endif
        </div>
    </section>
</div>
