<div class="contents">
    <x-structure.page-header icon="home" label="{{ session('auth:company')->name }}" :breadcrumbs="[session('auth:company')->name => null]" />

    @if ($remainingSteps)
        <div class="bg-main-background border-borders flex flex-col gap-6 rounded-lg border p-4 md:gap-8">
            <h2 class="text-main-text font-heading text-left text-lg font-semibold lg:text-xl">Passo-a-passo</h2>

            @if ($currentStep === 'logo')
                <p class="text-main-text text-left text-sm font-normal md:text-base">Bem-vindo! Para começar, preparamos um passo a passo com 3 ações recomendadas antes de você explorar o restante do sistema. São tarefas simples e rápidas — e você pode pulá-las caso não sejam necessárias no momento.</p>
            @endif

            <ul class="grid w-full grid-cols-3 gap-2 sm:gap-4">
                <li class="{{ $currentStep === 'logo' ? 'border-primary-solid' : 'border-secondary-text' }} flex items-center gap-2 border-t-2 px-1 py-3 sm:px-2">
                    @if (in_array('logo', $remainingSteps))
                        <span class="{{ $currentStep === 'logo' ? 'text-primary-solid' : 'text-secondary-text' }} hidden text-center text-base font-semibold sm:block">1</span>
                    @else
                        <x-icon icon="circle-check" class="text-primary-solid hidden h-5 w-5 object-scale-down sm:block" />
                    @endif

                    <h3 class="{{ $currentStep === 'logo' ? 'text-primary-solid' : 'text-secondary-text' }} text-center text-sm font-semibold sm:text-left md:text-base lg:text-lg">Logomarca da empresa</h3>
                </li>

                <li class="{{ $currentStep === 'import-users' ? 'border-primary-solid' : 'border-secondary-text' }} flex items-center gap-2 border-t-2 px-1 py-3 sm:px-2">
                    @if (in_array('import-users', $remainingSteps))
                        <span class="{{ $currentStep === 'import-users' ? 'text-primary-solid' : 'text-secondary-text' }} hidden text-center text-base font-semibold sm:block">2</span>
                    @else
                        <x-icon icon="circle-check" class="text-primary-solid hidden h-5 w-5 object-scale-down sm:block" />
                    @endif

                    <h3 class="{{ $currentStep === 'import-users' ? 'text-primary-solid' : 'text-secondary-text' }} text-center text-sm font-semibold sm:text-left md:text-base lg:text-lg">Importar/criar funcionários</h3>
                </li>

                <li class="{{ $currentStep === 'schedule-campaign' ? 'border-primary-solid' : 'border-secondary-text' }} flex items-center gap-2 border-t-2 px-1 py-3 sm:px-2">
                    @if (in_array('schedule-campaign', $remainingSteps))
                        <span class="{{ $currentStep === 'schedule-campaign' ? 'text-primary-solid' : 'text-secondary-text' }} hidden text-center text-base font-semibold sm:block">3</span>
                    @else
                        <x-icon icon="circle-check" class="text-primary-solid hidden h-5 w-5 object-scale-down sm:block" />
                    @endif

                    <h3 class="{{ $currentStep === 'schedule-campaign' ? 'text-primary-solid' : 'text-secondary-text' }} text-center text-sm font-semibold sm:text-left md:text-base lg:text-lg">Agendar Campanha</h3>
                </li>
            </ul>

            @if ($currentStep === 'logo')
                <livewire:private.home.company-home-upload-logo-component />
            @endif

            @if ($currentStep === 'import-users')
                <p class="text-main-text text-left text-sm font-normal md:text-base">Os funcionários são os participantes das campanhas de pesquisa. Você pode importar uma lista em planilha ou cadastrar manualmente, um por vez.</p>
                <livewire:private.home.company-home-import-users-component />
            @endif

            @if ($currentStep === 'schedule-campaign')
                <p class="text-main-text text-left text-sm font-normal md:text-base">Uma campanha define o período em que os funcionários responderão aos questionários de avaliação. Ela tem data de início, data de encerramento e um tipo de formulário — que determina o que será avaliado. @if(session('auth:company')->can_access_organizational)O sistema oferece duas avaliações: <span class="font-semibold">Riscos Psicossociais</span> (fatores do ambiente de trabalho que afetam a saúde mental) e <span class="font-semibold">Clima Organizacional</span> (percepção dos funcionários sobre a empresa).@else O sistema avalia <span class="font-semibold">Riscos Psicossociais</span> — fatores do ambiente de trabalho que afetam a saúde e o bem-estar dos funcionários.@endif</p>
                <livewire:private.home.company-home-schedule-campaign-component />
            @endif
        </div>
    @else
        @if (session()->has('message'))
            <div class="bg-primary-solid/50 border-primary-solid rounded-sm border p-4">
                <span class="text-main-text font-heading text-left text-base font-normal">{{ session('message') }}</span>
            </div>
        @endif

        @if (session('auth:company')->activeCampaigns()->isNotEmpty())
            <section id="active-campaigns" class="space-y-4">
                <h2 class="text-main-text font-heading text-left text-lg font-semibold lg:text-xl">Campanhas Ativas</h2>

                <ul class="flex flex-col gap-4">
                    @if ($activePsychosocialCampaign)
                        <li class="bg-secondary-background border-borders flex flex-col items-center gap-4 rounded-sm border p-4 md:flex-row md:justify-between">
                            <div class="flex items-center gap-4">
                                <x-icon icon="brain" class="text-primary-solid h-7 w-7 object-scale-down" />
                                <span class="text-main-text font-heading flex-1 text-left text-sm font-normal sm:text-base lg:text-lg">{{ $activePsychosocialCampaign->name }}</span>
                            </div>
                            
                            <x-actions.button :href="route('psychosocial.dashboard', session('auth:company')->latestPsychosocialCampaign())" fitSize>
                                <span class="text-main-background text-center text-sm font-semibold">Acompanhar resultados</span>
                            </x-actions.button>
                        </li>
                    @endif

                    @if ($activeOrganizationalCampaign)
                        <li class="bg-secondary-background border-borders flex flex-col items-center gap-4 rounded-sm border p-4 md:flex-row md:justify-between">
                            <div class="flex items-center gap-4">
                                <x-icon icon="cloud" class="text-primary-solid h-7 w-7 object-scale-down" />
                                <span class="text-main-text font-heading flex-1 text-left text-sm font-normal sm:text-base lg:text-lg">{{ $activeOrganizationalCampaign->name }}</span>
                            </div>
                            <x-actions.button :href="route('organizational.dashboard', session('auth:company')->latestOrganizationalCampaign())" fitSize>
                                <span class="text-main-background text-center text-sm font-semibold">Acompanhar resultados</span>
                            </x-actions.button>
                        </li>
                    @endif
                </ul>
            </section>
        @endif

        @if (session('auth:company')->scheduledCampaigns()->isNotEmpty())
            <section id="active-campaigns" class="space-y-4">
                <h2 class="text-main-text font-heading text-left text-lg font-semibold lg:text-xl">Campanhas Agendadas</h2>

                <ul class="flex flex-col gap-4">
                    @foreach (session('auth:company')->scheduledCampaigns() as $scheduledCampaign)
                        <li class="bg-secondary-background border-borders flex flex-col items-center gap-4 rounded-sm border p-4 md:flex-row md:justify-between">
                            <div class="flex items-center gap-4">
                                <x-icon icon="calendar-check" class="text-primary-solid h-7 w-7 object-scale-down" />
                                <span class="text-main-text font-heading flex-1 text-left text-sm font-normal sm:text-base lg:text-lg">{{ $scheduledCampaign->name . ' - (' . $scheduledCampaign->start_date->format('d/m/Y - H:i') . ')' }}</span>
                            </div>
                            <x-actions.button :href="route('campaign.edit', $scheduledCampaign)" fitSize>
                                <span class="text-main-background text-center text-sm font-semibold">Editar</span>
                            </x-actions.button>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

        <section id="shortcuts" class="space-y-4">
            <h2 class="text-main-text font-heading text-left text-lg font-semibold lg:text-xl">Atalhos</h2>

            <ul class="flex flex-col gap-4">
                <li class="bg-secondary-background border-borders flex flex-col items-center gap-4 rounded-sm border p-4 md:flex-row md:justify-between">
                    <div class="flex items-center gap-4">
                        <x-icon icon="calendar-clock" class="text-primary-solid h-7 w-7 object-scale-down" />
                        <span class="text-main-text font-heading flex-1 text-left text-sm font-normal sm:text-base lg:text-lg">Agendar campanha de testes</span>
                    </div>
                    <x-actions.button :href="route('campaign.create')"  fitSize>
                        <span class="text-main-background text-center text-sm font-semibold">Agendar campanha</span>
                    </x-actions.button>
                </li>

                <li class="bg-secondary-background border-borders flex flex-col items-center gap-4 rounded-sm border p-4 md:flex-row md:justify-between">
                    <div class="flex items-center gap-4">
                        <x-icon icon="users" class="text-primary-solid h-7 w-7 object-scale-down" />
                        <span class="text-main-text font-heading flex-1 text-left text-sm font-normal sm:text-base lg:text-lg">Visualizar lista de funcionários</span>
                    </div>
                    <x-actions.button :href="route('user.index')" fitSize>
                        <span class="text-main-background text-center text-sm font-semibold">Visualizar funcionários</span>
                    </x-actions.button>
                </li>
            </ul>
        </section>
    @endif
</div>
