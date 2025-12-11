<div class="contents">
    <x-structure.page-header icon="cloud" label="Formulários de Pesquisa de Clima" :breadcrumbs="['Formulários de Pesquisa de Clima' => null]" />

    <livewire:private.organizational.custom-collection.custom-collection-create-component />

    @if ($customCollections && $customCollections->count())
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 items-start">
            @foreach ($customCollections as $customCollection)
                <div class="p-6 rounded-2xl bg-secondary-background border border-borders shadow-sm flex flex-col gap-4">
                    <header class="flex justify-between items-start">
                        <div class="w-14 h-14 bg-primary-solid rounded-full flex items-center justify-center">
                            <x-icon icon="cloud" class="text-main-background h-6 w-6 object-scale-down" />
                        </div>
                    </header>

                    <div class="flex flex-col gap-2">
                        <x-info-item label="Nome do Formulário" :value="$customCollection->name" truncate />
                    </div>

                    <x-actions.button :href="route('organizational.custom-collection.edit', $customCollection)">
                        <span class="text-main-background text-center text-sm font-semibold">Editar</span>
                    </x-actions.button>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex w-full">
            <p class="text-secondary-text font-heading text-center text-sm font-normal sm:text-base">Você ainda não tem Formulários de Pesquisa personalizados.</p>
        </div>
    @endif
</div>