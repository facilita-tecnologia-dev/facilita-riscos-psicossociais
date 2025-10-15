<div x-data="{ absenceEditModalOpen: false }">
    <x-action tag="button" type="button" width="full" @click="absenceEditModalOpen = true">
        <i class="fa-solid fa-pencil"></i>
    </x-action>

    {{-- Fundo do modal --}}
    <div class="flex z-50 left-0 top-0 fixed w-screen h-screen bg-gray-800/30 px-4 py-8 items-center justify-center" x-show="absenceEditModalOpen" x-on:absence:updated.window="absenceEditModalOpen = false" x-cloak @click.self="absenceEditModalOpen = false">
        <x-modal.wrapper class="max-w-[450px] bg-white p-4 rounded shadow">
            <x-modal.title>Editar afastamento</x-modal.title>

            <form class="w-full space-y-4" wire:submit.prevent="update">                
                <x-form.select wire:model="cid" name="cid" label="Código CID" value="{{ old('cid', $absence->cid_id) }}" :options="$cids" defaultValue="Selecione um CID" />

                <x-form.select wire:model="department" name="department" label="Setor" value="{{ old('department', $absence->department) }}" :options="$departments" defaultValue="Selecione um setor" />

                <x-form.select wire:model="occupation" name="occupation" label="Função" value="{{ old('occupation', $absence->occupation) }}" :options="$occupations" defaultValue="Selecione uma função" />

                <x-form.input-text wire:model="duration" type="number" name="duration" label="Duração (dias)" value="{{ old('duration', $absence->duration) }}" placeholder="Digite a duração do afastamento" />


                <button type="submit" class="w-full py-2 px-4 bg-primary-solid rounded-md border border-borders cursor-pointer">
                    <div wire:loading wire:target="update">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="update" class="text-main-background text-center text-sm font-normal">Salvar</span>
                </button>
            </form>
        </x-modal.wrapper>
    </div>
</div>