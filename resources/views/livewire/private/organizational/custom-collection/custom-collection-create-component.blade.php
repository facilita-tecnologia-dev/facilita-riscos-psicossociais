<div x-data="{ createCollectionModalOpen: false }" x-on:open-collection-modal.window="createCollectionModalOpen = true" x-on:close-collection-modal.window="createCollectionModalOpen = false" class="contents">
    <x-actions.button  wire:click="openCollectionModal" class="w-full">
        <span class="font-heading text-main-background text-center text-sm font-semibold">Criar novo formulário</span>
    </x-actions.button>

    <div x-show="createCollectionModalOpen" x-transition.opacity x-cloak class="fixed inset-0 z-30 flex items-center justify-center bg-black/60 px-4">
        <div x-on:click.away="$wire.closeCollectionModal()" class="bg-secondary-background border-borders w-full max-w-xl flex flex-col gap-6 rounded-lg border p-6 shadow-sm">
            <header class="flex w-full items-center justify-between">
                <h2 class="font-heading text-main-text text-left text-base sm:text-lg font-semibold">Criar novo formulário</h2>
                <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Use este modal para criar um novo formulário de pesquisa — começando do zero ou a partir do modelo padrão.">
                    <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                </div>
            </header>

            <x-form.input-text wireModel="name" name="name" label="Nome do Formulário" placeholder="Digite o nome do formulário..." tooltip="Digite o nome do formulário" />

            <x-actions.button wire:click="createFromDefault" class="w-full">
                <div wire:loading wire:target="createFromDefault">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>
                <span wire:loading.remove wire:target="createFromDefault" class="font-heading text-main-background text-center text-sm font-semibold">Criar formulário</span>
            </x-actions.button>
        </div>
    </div>
</div>
