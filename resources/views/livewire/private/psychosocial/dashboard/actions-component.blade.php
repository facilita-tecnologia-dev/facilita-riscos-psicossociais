<div class="border-borders bg-main-background flex flex-col gap-4 rounded-lg border p-4 md:col-span-2 xl:col-span-1">
    <header class="flex items-center justify-between">
        <h2 class="text-main-text font-heading text-left text-lg font-semibold">Ações</h2>

        <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Neste card, você pode usar os botões para acessar outras páginas importantes para a sua avaliação de riscos psicossociais.">
            <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
        </div>
    </header>

    <div class="flex flex-col md:flex-row xl:flex-col gap-3">
        <x-new-components.actions.button href="" class="w-full">
            <span class="font-heading text-main-background text-center text-sm font-semibold">Editar Medidas de Controle</span>
        </x-new-components.actions.button>

        @if(session('auth:company')->usesHSE())
            <x-new-components.actions.button :href="route('psychosocial.absences')" class="w-full">
                <span class="font-heading text-main-background text-center text-sm font-semibold">Editar Indicadores Epidemiológicos</span>
            </x-new-components.actions.button>
        @else
            <x-new-components.actions.button :href="route('psychosocial.indicators')" class="w-full">
                <span class="font-heading text-main-background text-center text-sm font-semibold">Editar Dados de Desempenho Organizacional</span>
            </x-new-components.actions.button>
        @endif

        <livewire:private.psychosocial.report.generate-report-component :campaign="$psychosocialCampaign">
    </div>
</div>
