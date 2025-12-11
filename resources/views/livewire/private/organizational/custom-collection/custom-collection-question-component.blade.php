<div class="grid grid-cols-[1fr_auto] gap-1 items-center">
    <x-new-components.form.input-text wireModel="statement" name="statement" placeholder="Conteúdo" wire:blur='update' class="!h-[34px] !text-sm" isRequired />

    <x-new-components.actions.button class="!bg-danger" wire:click='delete' data-tippy-content="Excluir questão" slim>
        <div wire:loading wire:target="delete">
            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
        </div>
        
        <x-icon wire:loading.remove wire:target="delete" icon="trash" class="text-main-background h-4 w-4 object-scale-down" />
    </x-new-components.actions.button>
</div>
