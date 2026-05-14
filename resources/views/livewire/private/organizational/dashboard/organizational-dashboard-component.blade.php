<div class="contents">
    @if ($organizationalCampaign)
        <div class="flex items-center gap-2">
            <x-icon icon="cloud" class="text-main-text h-6 w-6 object-scale-down" />
            <h1 class="text-main-text font-heading text-left text-base sm:text-xl font-semibold">{{ $organizationalCampaign->name }} ({{ $organizationalCampaign->start_date->year }})</h1>
        </div>
    
        <section class="flex flex-col gap-4">
            @if($organizationalCampaign->start_date->year < now()->year)
                <div class="border-alert bg-main-background flex rounded-lg border px-4 py-3">
                    <span class="text-sm text-secondary-text text-left font-normal">Esta campanha não foi realizada no ano atual, tendo sido concluída no ano de {{ $organizationalCampaign->start_date->year }}. Para visualizar campanhas anteriores ou agendar uma nova avaliação de riscos psicossociais, acesse a página de Campanhas.</span>
                </div>
            @endif

            <div id="date-n-status-infos" class="border-borders bg-main-background flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3 rounded-lg border px-4 py-3">
                <span class="text-sm text-secondary-text text-left font-normal">Data de Início: {{ $organizationalCampaign->start_date->format('d/m/Y') }}</span>
                <div class="h-1.5 w-1.5 rounded-full bg-secondary-text hidden sm:block"></div>
                <span class="text-sm text-secondary-text text-left font-normal">Data de Encerramento: {{ $organizationalCampaign->end_date->format('d/m/Y') }}</span>
                <div class="h-1.5 w-1.5 rounded-full bg-secondary-text hidden sm:block"></div>
                <span class="text-sm text-secondary-text text-left font-normal">Status: {{ $organizationalCampaign->status->label() }}</span>
            </div>


            <div id="relevant-infos" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 items-start gap-4">
                <livewire:private.organizational.dashboard.organizational-campaign-engagement-component :engagement="$engagement" />

                <livewire:private.organizational.dashboard.control-panel-component />

                <livewire:private.organizational.dashboard.actions-component :campaign="$organizationalCampaign" />
            </div>

            <div id="type-n-search" class="flex flex-col-reverse xl:grid xl:grid-cols-2 xl:items-start gap-4">
                <livewire:private.organizational.dashboard.visualization-type-component />

                <livewire:private.organizational.dashboard.filter-component />
            </div>

            @if ($organizationalResults)
                <div wire:loading class="w-full">
                    <div class="flex w-full items-center justify-center gap-2 py-6">
                        <x-icon icon="loading" class="text-primary-solid h-5 w-5 animate-spin object-scale-down" />
                        <span class="text-secondary-text text-left text-sm font-normal">Carregando dashboard...</span>
                    </div>
                </div>
  
                <div wire:loading.remove id="results" class="flex flex-col gap-4">
                    @if(empty($filters))
                        @if(isset($organizationalResults['general-satisfaction-by-group']) && $organizationalResults['general-satisfaction-by-group']->count())
                            <div id="general-satisfaction-by-group" class="border-borders bg-main-background flex flex-col gap-4 rounded-lg border px-4 py-4">
                                <header class="flex w-full items-center justify-between">
                                    <h3 class="text-main-text text-left text-lg font-semibold">Índice Geral de Satisfação por grupo</h3>

                                    <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Este card apresenta o nível de satisfação geral em cada uma das dimensões.">
                                        <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                                    </div>
                                </header>

                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($organizationalResults['general-satisfaction-by-group'] as $group => $satisfaction)
                                        <div class="flex flex-col gap-1.5">
                                            <header class="flex items-center justify-between">
                                                <span class="text-sm text-left text-main-text font-normal">{{ App\Enums\OC\OCGroup::from($group)->label() }}</span>
                                                <span class="text-xs text-left text-secondary-text font-semibold">{{ $satisfaction }}%</span>
                                            </header>
                                            <div class="bg-borders h-5 w-full rounded-sm">
                                                <div style="background-color: {{ App\Enums\OC\OCGroup::from($group)->color() }}; width: {{ $satisfaction }}%" class="h-full rounded-sm"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif

                    @if($visualization_type === App\Enums\OC\OCVisualization::GENERAL->value)
                        @if(isset($organizationalResults['division-factor-satisfaction-by-group']) && $organizationalResults['division-factor-satisfaction-by-group']->count())
                            <section id="division-factor-satisfaction-by-group" class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                                @foreach ($organizationalResults['division-factor-satisfaction-by-group'] as $group => $satisfactions)                         
                                    <div class="border-borders bg-main-background flex flex-col gap-4 rounded-lg border px-4 py-4">
                                        <header class="flex w-full items-center justify-between">
                                            <h3 class="text-main-text text-left text-lg font-semibold">{{ App\Enums\OC\OCGroup::from($group)->label() }}</h3>

                                            <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Este card apresenta o nível de satisfação geral e de cada {{ strtolower(App\Enums\OC\OCEvaluation::from($evaluation_type)->label()) }} na dimensão '{{ App\Enums\OC\OCGroup::from($group)->label() }}'.">
                                                <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                                            </div>
                                        </header>

                                        <div class="flex flex-col gap-4">
                                            <div class="flex flex-col gap-1.5 p-2 border border-borders rounded-md">
                                                <header class="flex items-center justify-between">
                                                    <span class="text-sm text-left text-main-text font-normal">Geral</span>
                                                    <span class="text-xs text-left text-secondary-text font-semibold">{{ $satisfactions['Geral'] }}%</span>
                                                </header>
                                                <div class="bg-borders h-5 w-full rounded-sm">
                                                    <div style="background-color: {{ App\Enums\OC\OCGroup::from($group)->color() }}; width: {{ $satisfactions['Geral'] }}%" class="h-full rounded-sm"></div>
                                                </div>
                                            </div>
                            
                                            @foreach ($satisfactions->except('Geral') as $divisionFactor => $satisfaction)
                                                <div class="flex flex-col gap-1.5 px-2">
                                                    <header class="flex items-center justify-between">
                                                        <span class="text-sm text-left text-main-text font-normal">{{ $divisionFactor }}</span>
                                                        <span class="text-xs text-left text-secondary-text font-semibold">{{ $satisfaction }}%</span>
                                                    </header>
                                                    <div class="bg-borders h-5 w-full rounded-sm">
                                                        <div style="width: {{ $satisfaction }}%" class="bg-primary-solid h-full rounded-sm"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </section>
                        @endif
                    @else
                        @if(isset($organizationalResults['division-factor-satisfaction-by-group']) && $organizationalResults['division-factor-satisfaction-by-group']->count())
                            <section id="division-factor-satisfaction-by-group" class="flex flex-col gap-6">
                                @foreach ($organizationalResults['division-factor-satisfaction-by-group'] as $group => $questions)                         
                                    <div class="border-borders bg-main-background flex flex-col gap-4 rounded-lg border px-4 py-4">
                                        <header class="flex w-full items-center justify-between">
                                            <h3 class="text-main-text text-left text-lg font-semibold">{{ App\Enums\OC\OCGroup::from($group)->label() }}</h3>

                                            <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Este card apresenta o nível de satisfação geral e de cada {{ strtolower(App\Enums\OC\OCEvaluation::from($evaluation_type)->label()) }} na dimensão '{{ App\Enums\OC\OCGroup::from($group)->label() }}'.">
                                                <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                                            </div>
                                        </header>
                                        
                                        @foreach ($questions as $question)
                                            <div class="flex flex-col gap-3 pb-6 border-b border-borders">
                                                <span class="text-base text-main-text text-left font-normal">{{ $question['statement'] }}</span>
    
                                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                                    <div class="flex flex-col gap-1.5 p-2 border border-borders rounded-md">
                                                        <header class="flex items-center justify-between">
                                                            <span class="text-sm text-left text-main-text font-normal">Geral</span>
                                                            <span class="text-xs text-left text-secondary-text font-semibold">{{ $question['satisfaction']['Geral'] }}%</span>
                                                        </header>
                                                        <div class="bg-borders h-5 w-full rounded-sm">
                                                            <div style="background-color: {{ App\Enums\OC\OCGroup::from($group)->color() }}; width: {{ $question['satisfaction']['Geral'] }}%" class="h-full rounded-sm"></div>
                                                        </div>
                                                    </div>
                                    
                                                    @foreach ($question['satisfaction']->except('Geral') as $divisionFactor => $satisfaction)
                                                        <div class="flex flex-col gap-1.5 px-2">
                                                            <header class="flex items-center justify-between">
                                                                <span class="text-sm text-left text-main-text font-normal">{{ $divisionFactor }}</span>
                                                                <span class="text-xs text-left text-secondary-text font-semibold">{{ $satisfaction }}%</span>
                                                            </header>
                                                            <div class="bg-borders h-5 w-full rounded-sm">
                                                                <div style="width: {{ $satisfaction }}%" class="bg-primary-solid h-full rounded-sm"></div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </section>
                        @endif     
                    @endif
                </div>
            @else
                <div class="w-full flex-1 flex items-start justify-center pt-6">
                    <p class="text-secondary-text font-text text-center text-sm font-normal md:text-base">Nenhum resultado foi encontrado.</p>
                </div>
            @endif
        </section>
    @else
        <div class="grid grid-cols-1 items-start gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-secondary-background border-borders flex flex-col items-center gap-4 rounded-lg border p-4 shadow-sm sm:p-6 sm:col-span-2 lg:col-span-1">
                <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                    Oops! Parece que você ainda
                    <span class="font-semibold">não agendou uma campanha</span>
                    de Pesquisa de Clima Organizacional — por isso
                    <span class="font-semibold">o dashboard ainda não está disponível</span>
                    .
                </p>

                <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                    Lembre-se: se você quiser
                    <span class="font-semibold">customizar o formulário da pesquisa de clima</span>
                    faça-o obrigatoriamente
                    <span class="font-semibold">antes do agendamento da campanha</span>
                    . Uma vez agendada,
                    <span class="font-semibold">qualquer alteração posterior no formulário não será considerada.</span>
                </p>

                <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                    Você pode acessar a página de Formulários e a Lista de Feedbacks
                    <span class="font-semibold">através dos cards à direita</span>
                    .
                </p>
            </div>

            @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('organizationalCustomCollections', [\App\Models\User::class]))
                <div class="bg-secondary-background border-borders flex flex-col items-start gap-4 rounded-lg border p-4 shadow-sm sm:p-6">
                    <h2 class="text-main-text font-heading text-left text-base font-semibold sm:text-lg">Customizar formulários de Pesquisa de Clima</h2>

                    <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">Personalize os formulários para que se encaixem no contexto da sua organização. Além de modificar questões, você pode criar novos grupos de questões e até mesmo criar novos formulários completos.</p>

                    <x-actions.button :href="route('organizational.custom-collection.index')" class="w-full">
                        <span class="font-heading text-main-background text-center text-sm font-semibold">Acesar página de Formulários</span>
                    </x-actions.button>
                </div>
            @endif

            @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('organizationalDashboard', [\App\Models\User::class]))
                <div class="bg-secondary-background border-borders flex flex-col items-start gap-4 rounded-lg border p-4 shadow-sm sm:p-6">
                    <h2 class="text-main-text font-heading text-left text-base font-semibold sm:text-lg">Visualizar Lista de Feedbacks</h2>

                    <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">Visualize os feedbacks escritos pelos seus funcionários e extraia insights valiosos a partir de opiniões e sugestões que ajudam a aprimorar os processos internos da sua empresa.</p>

                    <x-actions.button :href="route('organizational.feedback')" class="w-full">
                        <span class="font-heading text-main-background text-center text-sm font-semibold">Acesar Lista de Feedbacks</span>
                    </x-actions.button>
                </div>
            @endif
        </div>
    @endif
</div>
