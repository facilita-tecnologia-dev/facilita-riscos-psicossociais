<form class="flex w-full flex-col items-start gap-4" id="filter-companies" wire:submit.prevent="submit">
    <x-form.input-text wireModel="full_name" name="full_name" label="Nome" placeholder="Digite o nome..." tooltip="Digite o nome do usuário" />
    <x-form.input-text wireModel="cpf" name="cpf" label="CPF" placeholder="Digite o cpf..." tooltip="Digite o cpf do usuário" />

    <x-form.select wireModel="type" name="type" label="Tipo" placeholder="Selecione o tipo de usuário" tooltip="Selecione o tipo de usuário desejado" :options="$userTypes" />
    <x-form.select wireModel="order_by" name="order_by" label="Ordenar por" placeholder="Selecione o tipo de ordenação" tooltip="Selecione o tipo de ordenação desejado" :options="$userOrderTypes" />

    <footer class="flex w-full items-center gap-2">
        <x-actions.button class="!bg-report-channel-primary-solid" type="submit">
            <div wire:loading wire:target="submit">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Filtrar</span>
        </x-actions.button>

        <x-actions.button class="!bg-report-channel-primary-solid" fitSize type="button" wire:click="clear">
            <div wire:loading wire:target="clear">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <div wire:loading.remove wire:target="clear">
                <x-icon icon="filter-clear" class="text-main-background h-4 w-4 object-scale-down" />
            </div>
        </x-actions.button>
    </footer>
</form>
