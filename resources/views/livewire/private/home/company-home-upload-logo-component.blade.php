<form class="flex flex-col gap-4" wire:submit.prevent="submit">
    <p class="text-main-text text-left text-sm font-normal md:text-base">Adicione a logomarca da sua empresa para personalizar o sistema e incluí-la nos relatórios. Se nenhuma logomarca for cadastrada, usaremos apenas o nome da empresa. Você também poderá cadastrar a logomarca posteriormente, se preferir. Para pular esta etapa agora, clique em “Pular etapa”.</p>

    <x-form.input-photo wireModel="logo" name="logo" format="w-fit min-w-14 h-14 rounded-md" :value="$logo" tooltip="Clique para adicionar uma logomarca" />

    <div class="grid w-full grid-cols-3 gap-2 sm:gap-4">
        <x-actions.button class="col-span-2">
            <div wire:loading wire:target="submit">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Salvar logomarca</span>
        </x-actions.button>

        <x-actions.button class="!bg-danger" type="button" wire:click="nextStep">
            <div wire:loading wire:target="nextStep">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="nextStep" class="font-heading text-main-background text-center text-sm font-semibold">Pular etapa</span>
        </x-actions.button>
    </div>
</form>
