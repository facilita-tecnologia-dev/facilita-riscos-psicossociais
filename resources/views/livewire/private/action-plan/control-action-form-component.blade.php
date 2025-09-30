<div class="flex gap-1">
    <div class="w-5/12">
        <input type="text" wire:model="content" wire:blur='update' placeholder="Medida" value="{{ $action->content }}" class="w-full py-1 px-2 text-sm bg-secondary-background border border-borders rounded-sm">
    </div>
    <div class="w-2/12">
        <input type="text" wire:model="deadline" wire:blur='update' placeholder="Prazo" value="{{ $action->deadline }}" class="w-full py-1 px-2 text-sm bg-secondary-background border border-borders rounded-sm">
    </div>
    <div class="w-2/12">
        <input type="text" wire:model="assignee" wire:blur='update' placeholder="Responsável" value="{{ $action->assignee }}" class="w-full py-1 px-2 text-sm bg-secondary-background border border-borders rounded-sm">
    </div>
    <div class="w-2/12">
        <input type="text" wire:model="status" wire:blur='update' placeholder="Status" value="{{ $action->status }}" class="w-full py-1 px-2 text-sm bg-secondary-background border border-borders rounded-sm">
    </div>
    <div class="w-1/12">
        <button wire:click='delete' class="bg-danger cursor-pointer w-full h-full rounded-sm text-main-background flex items-center justify-center" data-tippy-content="Excluir medida de controle">
            <div wire:loading.remove wire:target='delete'>
                <i class="fa-solid fa-trash pointer-events-none text-sm"></i> 
            </div>

            <div wire:loading wire:target='delete'>
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>   
        </button>
    </div>
</div>