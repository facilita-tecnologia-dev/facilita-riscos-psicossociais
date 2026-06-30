<div class="contents">
    <x-structure.page-header icon="calendar-clock" label="Lista de Campanhas" :breadcrumbs="['Lista de Campanhas' => null]" />

    @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('create', [\App\Models\Campaign::class]) && !(session('auth:company')->hasActiveTrial() && session('auth:company')->hasReachedTrialCampaignLimit()))
        <div>
            <x-actions.button :href="route('campaign.create')">
                <span class="text-main-background text-center text-sm font-semibold">Agendar nova campanha</span>
            </x-actions.button>
        </div>
    @endif

    @if(session('auth:company')->hasActiveTrial())
        <div class="px-4 py-2 bg-alert/20 border border-alert rounded-md cursor-pointer flex items-start flex-col gap-1">
            <span class="text-sm text-left text-main-text font-normal">
                O agendamento de campanhas está limitado por você estar utilizando o período de teste gratuito. Para liberar todas as funcionalidades do sistema, <a href="{{ route('company.subscription.index') }}" class="underline">é necessário regularizar sua assinatura</a>.
            </span>
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

                            @if($campaign->status !== App\Enums\Campaign\CampaignStatus::SCHEDULED || !$campaign->start_date->gt(now()))
                                <x-actions.button :href="$campaign->collection()->type === App\Enums\Campaign\CollectionType::PSYCHOSOCIAL ? route('psychosocial.dashboard', $campaign) : route('organizational.dashboard', $campaign)">
                                    <span class="text-main-background text-center text-sm font-semibold">Visualizar resultados</span>
                                </x-actions.button>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-6">
                    <div class="flex items-center gap-3">
                        <x-icon icon="calendar-clock" class="text-primary-solid h-6 w-6 object-scale-down shrink-0" />
                        <h3 class="text-main-text font-heading text-left text-base font-semibold">Nenhuma campanha agendada este ano</h3>
                    </div>
                    <p class="text-main-text text-left text-sm font-normal md:text-base">Uma campanha define o período em que os funcionários responderão aos questionários de avaliação. Após o encerramento, os resultados ficam disponíveis no dashboard para análise.</p>
                    @if(session('auth:company')->can_access_organizational)
                        <div class="flex flex-col gap-2">
                            <p class="text-main-text text-left text-sm font-semibold">Tipos de campanha disponíveis:</p>
                            <ul class="flex flex-col gap-1.5 pl-1">
                                <li class="flex items-start gap-2 text-sm text-main-text font-normal">
                                    <x-icon icon="brain" class="text-primary-solid h-4 w-4 object-scale-down shrink-0 mt-0.5" />
                                    <span><span class="font-semibold">Riscos Psicossociais</span> — avalia fatores do ambiente de trabalho que afetam a saúde mental e o bem-estar dos funcionários</span>
                                </li>
                                <li class="flex items-start gap-2 text-sm text-main-text font-normal">
                                    <x-icon icon="cloud" class="text-primary-solid h-4 w-4 object-scale-down shrink-0 mt-0.5" />
                                    <span><span class="font-semibold">Clima Organizacional</span> — mede a percepção dos funcionários sobre o ambiente, liderança, comunicação e cultura da empresa</span>
                                </li>
                            </ul>
                        </div>
                    @else
                        <p class="text-main-text text-left text-sm font-normal">A campanha de <span class="font-semibold">Riscos Psicossociais</span> avalia fatores do ambiente de trabalho que afetam a saúde mental e o bem-estar dos funcionários, gerando um relatório detalhado por setor e função.</p>
                    @endif
                    @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('create', [\App\Models\Campaign::class]))
                        <div>
                            <x-actions.button :href="route('campaign.create')" fitSize>
                                <span class="text-main-background text-center text-sm font-semibold">Agendar primeira campanha</span>
                            </x-actions.button>
                        </div>
                    @endif
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
