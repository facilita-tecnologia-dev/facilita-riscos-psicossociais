<div class="contents">
    @if ($psychosocialCampaign)
        <section class="flex flex-col gap-4">
            <div id="relevant-infos" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 items-start gap-4">
                <livewire:private.psychosocial.dashboard.psychosocial-campaign-engagement-component :engagement="$engagement" />

                <livewire:private.psychosocial.dashboard.control-panel-component />

                <livewire:private.psychosocial.dashboard.actions-component :campaign="$psychosocialCampaign" />
            </div>

            <div id="caption-n-filters" class="flex flex-col-reverse xl:grid xl:grid-cols-2 xl:items-start gap-4">
                <div class="border-borders bg-main-background flex flex-col gap-6 rounded-lg border p-4">
                    <header class="flex items-center justify-between">
                        <h2 class="text-main-text font-heading text-left text-lg font-semibold">Legenda</h2>

                        <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Essa legenda ajuda você a ler os riscos psicosociais identificados.">
                            <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                        </div>
                    </header>

                    <div class="flex items-center gap-4 md:gap-6 flex-wrap">
                        @php
                            $caption = session('auth:company')->usesHSE() ? App\Enums\Psychosocial\HSE\HSERisk::cases() : App\Enums\Psychosocial\PROART\PROARTRisk::cases();
                        @endphp

                        @foreach ($caption as $risk)
                            <div class="flex items-center gap-2">
                                <div style="border-color: {{ $risk->color() }}" class="h-4 w-4 rounded-full border-3 bg-transparent"></div>
                                <span class="text-main-text text-left text-sm leading-relaxed font-normal">{{ $risk->label() }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <livewire:private.psychosocial.dashboard.filter-component />
            </div>

            @if ($psychosocialResults)
                <div wire:loading class="w-full">
                    <div class="flex w-full items-center justify-center gap-2 py-6">
                        <x-icon icon="loading" class="text-primary-solid h-5 w-5 animate-spin object-scale-down" />
                        <span class="text-secondary-text text-left text-sm font-normal">Carregando dashboard...</span>
                    </div>
                </div>

                <div wire:loading.remove id="results" class="flex flex-col gap-4">
                    <header class="flex items-center justify-between">
                        <h2 class="text-main-text font-heading text-left text-2xl font-semibold">Riscos Identificados</h2>
                    </header>

                    <div class="flex flex-col gap-6">
                        @foreach ($psychosocialResults as $divisionFactor => $groups)
                            <div class="border-borders bg-main-background flex flex-col gap-4 rounded-lg border px-4 py-4 md:py-6">
                                <header class="bg-secondary-background border-borders flex items-center justify-center rounded-md border p-3">
                                    <h3 class="text-main-text text-center text-lg md:text-xl font-semibold">{{ $divisionFactor }}</h3>
                                </header>

                                @foreach ($groups as $group => $hazards)
                                    <div class="bg-main-background flex flex-col gap-4 rounded-md">
                                        <header class="flex">
                                            @php
                                                $groupName = session('auth:company')->usesHSE() ? App\Enums\Psychosocial\HSE\HSEGroup::from($group)->label() : App\Enums\Psychosocial\PROART\PROARTGroup::from($group)->label();
                                            @endphp

                                            <h3 class="text-main-text text-left text-base font-semibold">{{ $groupName }}</h3>
                                        </header>
                                        <div class="grid grid-cols-1 md:grid-cols-2 items-start gap-4">
                                            @foreach ($hazards as $hazardName => $evaluation)
                                                <livewire:private.psychosocial.dashboard.risk-item wire:key="{{ uniqid() }}" hazardName="{{ $hazardName }}" :evaluation="$evaluation['risk']['evaluated']" :controlActions="$evaluation['control_actions']"/>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="w-full flex-1 flex items-start justify-center pt-6">
                    <p class="text-secondary-text font-text text-center text-sm font-normal md:text-base">Nenhum resultado foi encontrado.</p>
                </div>
            @endif
        </section>
    @else
        <div class="grid grid-cols-1 items-start gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-secondary-background border-borders flex flex-col items-start gap-4 rounded-lg border p-4 shadow-sm sm:col-span-2 sm:p-6 lg:col-span-1">
                <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                    Oops! Parece que você ainda
                    <span class="font-semibold">não agendou uma campanha</span>
                    de Avaliação de Riscos Psicossociais — por isso
                    <span class="font-semibold">o dashboard ainda não está disponível</span>
                    .
                </p>

                <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                    Enquanto isso, você pode aproveitar para configurar outros itens importantes:
                    <span class="font-semibold">atualizar os indicadores epidemiológicos</span>
                    (que tornam a avaliação mais precisa e direcionada) e
                    <span class="font-semibold">revisar as medidas de controle e prevenção de riscos</span>
                    .
                </p>

                <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                    Para acessar essas configurações,
                    <span class="font-semibold">utilize os cards disponíveis à direita</span>
                    .
                </p>
            </div>

            @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('psychosocialIndicators', [\App\Models\User::class]))
                <div class="bg-secondary-background border-borders flex flex-col items-start gap-4 rounded-lg border p-4 shadow-sm sm:p-6">
                    <h2 class="text-main-text font-heading text-left text-base font-semibold sm:text-lg">Editar Indicadores Epidemiológicos</h2>

                    <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                        Os indicadores epidemiológicos auxiliam na avaliação dos riscos psicossociais, tornando-a mais
                        <span class="font-semibold">precisa e direcionada</span>
                        .
                    </p>

                    <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                        Eles contribuem tanto para
                        <span class="font-semibold">identificar perigos psicossociais específicos</span>
                        quanto para
                        <span class="font-semibold">direcionar a análise</span>
                        desses riscos nos diferentes setores e funções da empresa.
                    </p>


                    @if(session('auth:company')->usesHSE())
                        <x-actions.button :href="route('psychosocial.absences')" class="w-full">
                            <span class="font-heading text-main-background text-center text-sm font-semibold">Editar Indicadores Epidemiológicos</span>
                        </x-actions.button>
                    @else
                        <x-actions.button :href="route('psychosocial.indicators')" class="w-full">
                            <span class="font-heading text-main-background text-center text-sm font-semibold">Editar Dados de Desempenho Organizacional</span>
                        </x-actions.button>
                    @endif
                </div>
            @endif

            @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('psychosocialControlActions', [\App\Models\User::class]))
                <div class="bg-secondary-background border-borders flex flex-col items-start gap-4 rounded-lg border p-4 shadow-sm sm:p-6">
                    <h2 class="text-main-text font-heading text-left text-base font-semibold sm:text-lg">Editar Medidas de Controle</h2>

                    <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                        As medidas de controle e prevenção ajudam a
                        <span class="font-semibold">reduzir ou eliminar os riscos psicossociais</span>
                        identificados na empresa.
                    </p>

                    <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                        Elas
                        <span class="font-semibold">orientam ações práticas e direcionadas para cada perigo mapeado</span>
                        , garantindo um ambiente de trabalho mais seguro e saudável.
                    </p>

                    <x-actions.button :href="route('psychosocial.control-action')" class="w-full">
                        <span class="font-heading text-main-background text-center text-sm font-semibold">Editar Medidas de Controle</span>
                    </x-actions.button>
                </div>
            @endif
        </div>
    @endif
</div>
