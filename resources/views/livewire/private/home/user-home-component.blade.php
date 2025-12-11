<div class="contents">
    <x-new-components.structure.page-header icon="home" label="{{ session('auth:company')->name }}" :breadcrumbs="[session('auth:company')->name => null]" />

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
                        @if(session('auth:user')->hasAnsweredCampaign($this->activePsychosocialCampaign->id))
                            <span class="text-sm text-secondary-text text-left font-normal">Respondido</span>
                        @else
                            @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('answer', [\App\Models\Campaign::class]))
                                <x-new-components.actions.button :href="route('campaign.answer', $activePsychosocialCampaign)" fitSize>
                                    <span class="text-main-background text-center text-sm font-semibold">Responder</span>
                                </x-new-components.actions.button>
                            @endif
                        @endif
                    </li>
                @endif

                @if ($activeOrganizationalCampaign)
                    <li class="bg-secondary-background border-borders flex flex-col items-center gap-4 rounded-sm border p-4 md:flex-row md:justify-between">
                        <div class="flex items-center gap-4">
                            <x-icon icon="cloud" class="text-primary-solid h-7 w-7 object-scale-down" />
                            <span class="text-main-text font-heading flex-1 text-left text-sm font-normal sm:text-base lg:text-lg">{{ $activeOrganizationalCampaign->name }}</span>
                        </div>
           
                        @if(session('auth:user')->hasAnsweredCampaign($this->activeOrganizationalCampaign->id))
                            <span class="text-sm text-secondary-text text-left font-normal">Respondido</span>
                        @else
                            <x-new-components.actions.button :href="route('campaign.answer', $activeOrganizationalCampaign)" fitSize>
                                <span class="text-main-background text-center text-sm font-semibold">Responder</span>
                            </x-new-components.actions.button>
                        @endif
                    </li>
                @endif
            </ul>
        </section>
    @endif

    <section id="shortcuts" class="space-y-4">
        <h2 class="text-main-text font-heading text-left text-lg font-semibold lg:text-xl">Atalhos</h2>

        <ul class="flex flex-col gap-4">
            <li class="bg-secondary-background border-borders flex flex-col items-center gap-4 rounded-sm border p-4 md:flex-row md:justify-between">
                <div class="flex items-center gap-4">
                    <x-icon icon="user-check" class="text-primary-solid h-7 w-7 object-scale-down" />
                    <span class="text-main-text font-heading flex-1 text-left text-sm font-normal sm:text-base lg:text-lg">Visualizar meu perfil no sistema</span>
                </div>
                <x-new-components.actions.button :href="route('user.show', session('auth:user'))" fitSize>
                    <span class="text-main-background text-center text-sm font-semibold">Visualizar meu perfil</span>
                </x-new-components.actions.button>
            </li>
        </ul>
    </section>
</div>
