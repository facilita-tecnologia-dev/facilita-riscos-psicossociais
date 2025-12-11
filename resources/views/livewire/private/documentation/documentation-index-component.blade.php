<div class="contents">
    <x-structure.page-header icon="books" label="Documentação" :breadcrumbs="['Documentação' => null]" />


    <div class="space-y-4">
        <li class="bg-secondary-background border-borders flex flex-col items-center gap-4 rounded-sm border p-4 md:flex-row md:justify-between">
            <div class="flex items-center gap-4">
                <x-icon icon="file-document" class="text-primary-solid h-7 w-7 object-scale-down" />
                <span class="text-main-text font-heading flex-1 text-left text-sm font-normal sm:text-base lg:text-lg">Critérios para Avaliação dos Riscos Psicossociais</span>
            </div>

            <x-actions.button wire:click='downloadDocumentation' fitSize>
                <div wire:loading wire:target="downloadDocumentation">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="downloadDocumentation" class="font-heading text-main-background text-center text-sm font-semibold">Fazer download</span>
            </x-actions.button>
        </li>

        <li class="bg-secondary-background border-borders flex flex-col items-center gap-4 rounded-sm border p-4 md:flex-row md:justify-between">
            <div class="flex items-center gap-4">
                <x-icon icon="file-document" class="text-primary-solid h-7 w-7 object-scale-down" />
                <span class="text-main-text font-heading flex-1 text-left text-sm font-normal sm:text-base lg:text-lg">Política de Privacidade</span>
            </div>

            <x-actions.button :href="route('documentation.policy')" fitSize>
                <span class="font-heading text-main-background text-center text-sm font-semibold">Acessar</span>
            </x-actions.button>
        </li>
    </div>
</div>
