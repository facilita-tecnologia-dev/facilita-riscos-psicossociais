<div class="border-borders bg-main-background flex flex-col gap-4 rounded-lg border p-4 md:col-span-2 xl:col-span-1">
    <header class="flex items-center justify-between">
        <h2 class="text-main-text font-heading text-left text-lg font-semibold">Ações</h2>

        <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Neste card, você pode usar os botões para acessar outras páginas importantes para a sua pesquisa de clima organizacional.">
            <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
        </div>
    </header>

    {{-- @if($organizationalCampaign->start_date->year == now()->year) --}}
        <div class="flex flex-col md:flex-row xl:flex-col gap-3">
            @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('viewAny', [\App\Models\UserFeedback::class]))
                <x-actions.button :href="route('organizational.feedback')" class="w-full">
                    <span class="font-heading text-main-background text-center text-sm font-semibold">Visualizar Lista de Feedbacks</span>
                </x-actions.button>
            @endif

            @if(Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('organizationalCustomCollections', [\App\Models\User::class]))
                <x-actions.button :href="route('organizational.custom-collection.index')" class="w-full">
                    <span class="font-heading text-main-background text-center text-sm font-semibold">Acesar Página de Formulários</span>
                </x-actions.button>
            @endif

            <livewire:private.organizational.dashboard.generate-report-component :campaign="$organizationalCampaign" />
        </div>
    {{-- @else
        <span class="text-secondary-text font-heading text-left text-sm font-normal">Não há ações disponíveis</span>
    @endif --}}
</div>
