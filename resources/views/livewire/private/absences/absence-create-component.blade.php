<div x-data="{ absenceCreateModalOpen: false }">
    <x-action tag="button" @click="absenceCreateModalOpen = true" width="full">
        Registrar afastamento
    </x-action>
    {{-- Fundo do modal --}}
    <div class="flex z-50 left-0 top-0 fixed w-screen h-screen bg-gray-800/30 px-4 py-8 items-center justify-center" x-show="absenceCreateModalOpen" x-on:absence:created.window="absenceCreateModalOpen = false" x-cloak @click.self="absenceCreateModalOpen = false">
        <x-modal.wrapper class="max-w-[450px] bg-white p-4 rounded shadow">
            <x-modal.title>Registrar afastamento</x-modal.title>

            <form class="w-full space-y-4" wire:submit.prevent="create">                
                <x-form.select wire:model="cid" name="cid" label="Código CID" value="{{ old('cid') }}" :options="$cids" defaultValue="Selecione um CID" />

                <x-form.select wire:model="department" name="department" label="Setor" value="{{ old('department') }}" :options="$departments" defaultValue="Selecione um setor" />

                <x-form.select wire:model="occupation" name="occupation" label="Função" value="{{ old('occupation') }}" :options="$occupations" defaultValue="Selecione uma função" />

                <x-form.input-text wire:model="duration" type="number" name="duration" label="Duração (dias)" value="{{ old('duration') }}" placeholder="Digite a duração do afastamento" />


                <button type="submit" class="w-full py-2 px-4 bg-primary-solid rounded-md border border-borders cursor-pointer">
                    <div wire:loading wire:target="create">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="create" class="text-main-background text-center text-sm font-normal">Registrar</span>
                </button>
            </form>
        </x-modal.wrapper>
    </div>
</div>