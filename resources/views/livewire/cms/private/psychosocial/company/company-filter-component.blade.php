<form class="flex w-full flex-col items-start gap-4" id="create-report" wire:submit.prevent="submit">
    <x-new-components.form.input-text wireModel="name" name="name" label="Razão Social" placeholder="Digite a razão social..." tooltip="Digite a razão social da empresa" />
    <x-new-components.form.input-text wireModel="cnpj" name="cnpj" label="CNPJ" placeholder="Digite o cnpj..." tooltip="Digite o cnpj da empresa" />

    <x-new-components.form.select wireModel="userCountRange" name="userCountRange" label="Faixa de funcionários" placeholder="Selecione a faixa de funcionários" tooltip="Selecione a faixa de funcionários" :options="$userCountRanges" />
    
    <x-new-components.form.select wireModel="orderBy" name="orderBy" label="Ordenar por" placeholder="Selecione o tipo de ordenação" tooltip="Selecione o tipo de ordenação desejado" :options="$companyOrderTypes" />

    <footer class="flex w-full items-center gap-2">
        <x-new-components.actions.button type="submit">
            <div wire:loading wire:target="submit">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Filtrar</span>
        </x-new-components.actions.button>

        <x-new-components.actions.button fitSize type="button" wire:click="clear">
            <div wire:loading wire:target="clear">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <div wire:loading.remove wire:target="clear">
                <x-icon icon="filter-clear" class="text-main-background h-4 w-4 object-scale-down" />
            </div>
        </x-new-components.actions.button>
    </footer>
</form>

