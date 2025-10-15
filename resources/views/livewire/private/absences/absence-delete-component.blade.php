<div x-data="{ absenceDeleteModalOpen: false }">
    <x-action tag="button" type="button" width="full" variant="danger" @click="absenceDeleteModalOpen = true">
        <i class="fa-solid fa-trash"></i>
    </x-action>

    {{-- Fundo do modal --}}
    <div class="flex z-50 left-0 top-0 fixed w-screen h-screen bg-gray-800/30 px-4 py-8 items-center justify-center" x-show="absenceDeleteModalOpen" x-on:absence:updated.window="absenceDeleteModalOpen = false" x-cloak @click.self="absenceDeleteModalOpen = false">
        <x-modal.wrapper class="max-w-[450px] bg-white p-4 rounded shadow">
            <x-modal.title>Excluir afastamento</x-modal.title>

            <p>Deseja mesmo excluir esse afastamento?</p>

            <button type="button" wire:click="delete" class="w-full py-2 px-4 bg-danger rounded-md border border-borders cursor-pointer">
                <div wire:loading wire:target="delete">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="delete" class="text-main-background text-center text-sm font-normal">Excluir</span>
            </button>
        </x-modal.wrapper>
    </div>
</div>