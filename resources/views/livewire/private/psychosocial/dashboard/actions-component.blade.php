<div class="border-borders bg-main-background flex flex-col gap-4 rounded-lg border p-4 md:col-span-2 xl:col-span-1">
    <header class="flex items-center justify-between">
        <h2 class="text-main-text font-heading text-left text-lg font-semibold">Ações</h2>

        <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Neste card, você pode usar os botões para acessar outras páginas importantes para a sua avaliação de riscos psicossociais.">
            <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
        </div>
    </header>

    <div class="flex flex-col md:flex-row xl:flex-col gap-3">
        @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('psychosocialControlActions', [\App\Models\User::class]))
            <x-actions.button :href="route('psychosocial.control-action')" class="w-full">
                <span class="font-heading text-main-background text-center text-sm font-semibold">Editar Medidas de Controle</span>
            </x-actions.button>
        @endif

        @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('psychosocialIndicators', [\App\Models\User::class]))
            <x-actions.button :href="route('psychosocial.indicators')" class="w-full">
                <span class="font-heading text-main-background text-center text-sm font-semibold">Editar Indicadores Organizacionais</span>
            </x-actions.button>
        @endif

        <livewire:private.psychosocial.report.generate-report-component :campaign="$psychosocialCampaign">
    </div>
</div>
