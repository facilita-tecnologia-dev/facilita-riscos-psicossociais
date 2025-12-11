<div class="grid grid-cols-2 md:flex gap-1 items-center">
    <div class="md:w-5/12">
        <x-form.input-text wireModel="content" name="content" placeholder="Medida" wire:blur='update' class="!h-[34px] !text-sm" isRequired />
    </div>
    <div class="md:w-2/12">
        <x-form.input-text wireModel="deadline" name="deadline" placeholder="Prazo" wire:blur='update' class="!h-[34px] !text-sm" isRequired />
    </div>
    <div class="md:w-2/12">
        <x-form.input-text wireModel="assignee" name="assignee" placeholder="Responsável" wire:blur='update' class="!h-[34px] !text-sm" isRequired />
    </div>
    <div class="md:w-2/12">
        <x-form.input-text wireModel="status" name="status" placeholder="Status" wire:blur='update' class="!h-[34px] !text-sm" isRequired />
    </div>

    <div class="col-span-2 md:w-1/12">
        <x-actions.button class="!bg-danger" wire:click='delete' data-tippy-content="Excluir medida de controle" slim>
            <div wire:loading wire:target="delete">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>
            
            <x-icon wire:loading.remove wire:target="delete" icon="trash" class="text-main-background h-4 w-4 object-scale-down" />
        </x-actions.button>
    </div>
</div>