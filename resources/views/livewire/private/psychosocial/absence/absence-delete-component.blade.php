<div x-data="{ absenceDeleteModalOpen: false }">
    <button @click="absenceDeleteModalOpen = true" class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-sm transition hover:bg-borders text-secondary-text border-borders border bg-transparent" data-tippy-content="Excluir afastamento">
        <x-icon icon="trash" class="h-5 w-5 object-scale-down text-inherit" />
    </button>

    <div x-show="absenceDeleteModalOpen" x-on:absence:updated.window="absenceDeleteModalOpen = false" x-cloak @click.self="absenceDeleteModalOpen = false" x-transition.opacity class="fixed inset-0 z-30 flex items-center justify-center bg-black/60 px-4">
        <div class="bg-secondary-background border-borders flex flex-col gap-4 w-full max-w-xl rounded-lg border p-6 shadow-sm">
            <header class="flex w-full items-center justify-between">
                <h2 class="font-heading text-main-text text-left text-base sm:text-lg font-semibold">Excluir afastamento</h2>

                <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Neste modal, você pode excluir um afastamento anteriormente cadastrado pela empresa.">
                    <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                </div>
            </header>

            <p class="text-base text-main-text text-left font-normal">Você deseja mesmo excluir este afastamento? Essa ação é irreversível e ele não poderá ser recuperado depois.</p>

            <x-actions.button class="!bg-danger" type="button" wire:click="delete">
                <div wire:loading wire:target="delete">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="delete" class="font-heading text-main-background text-center text-sm font-semibold">Excluir afastamento</span>
            </x-actions.button>
        </div>
    </div>
</div>