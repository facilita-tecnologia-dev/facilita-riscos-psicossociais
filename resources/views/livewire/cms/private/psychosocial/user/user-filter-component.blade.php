<form class="flex w-full flex-col items-start gap-4" id="filter-companies" wire:submit.prevent="submit">
    <x-form.input-text wireModel="name" name="name" label="Nome" placeholder="Digite o nome..." tooltip="Digite o nome do funcionário" />
    <x-form.input-text wireModel="cpf" name="cpf" label="CPF" placeholder="Digite o cpf..." tooltip="Digite o cpf do funcionário" />

    <x-form.select wireModel="department" name="department" label="Setor" placeholder="Selecione o setor" tooltip="Selecione o setor" :options="$departments" />
    
    <x-form.select wireModel="orderBy" name="orderBy" label="Ordenar por" placeholder="Selecione o tipo de ordenação" tooltip="Selecione o tipo de ordenação desejado" :options="$userOrderTypes" />

    <footer class="flex w-full items-center gap-2">
        <x-actions.button type="submit">
            <div wire:loading wire:target="submit">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Filtrar</span>
        </x-actions.button>

        <x-actions.button fitSize type="button" wire:click="clear">
            <div wire:loading wire:target="clear">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <div wire:loading.remove wire:target="clear">
                <x-icon icon="filter-clear" class="text-main-background h-4 w-4 object-scale-down" />
            </div>
        </x-actions.button>
    </footer>
</form>

