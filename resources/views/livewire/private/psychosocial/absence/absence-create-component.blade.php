<div x-data="{ absenceCreateModalOpen: false }">
    <x-actions.button type="button" @click="absenceCreateModalOpen = true">
        <span wire:loading.remove wire:target="delete" class="font-heading text-main-background text-center text-sm font-semibold">Registrar afastamento</span>
    </x-actions.button>

    <div x-show="absenceCreateModalOpen" x-on:absence:updated.window="absenceCreateModalOpen = false" x-cloak @click.self="absenceCreateModalOpen = false" x-transition.opacity class="fixed inset-0 z-30 flex items-center justify-center bg-black/60 px-4">
        <div class="bg-secondary-background border-borders flex flex-col gap-4 w-full max-w-xl rounded-lg border p-6 shadow-sm">
            <header class="flex w-full items-center justify-between">
                <h2 class="font-heading text-main-text text-left text-base sm:text-lg font-semibold">Registrar afastamento</h2>

                <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Neste modal, você pode registrar um afastamento.">
                    <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                </div>
            </header>

            <form class="w-full space-y-4" wire:submit.prevent="create">                
                <x-form.select wireModel="cid" name="cid" label="Código CID" placeholder="Selecione o código CID" tooltip="Selecione o Código CID" :options="$cids" required />
                <x-form.select wireModel="department" name="department" label="Setor" placeholder="Selecione o setor" tooltip="Selecione o setor" :options="$departments" required />
                <x-form.select wireModel="occupation" name="occupation" label="Função" placeholder="Selecione a função" tooltip="Selecione a função" :options="$occupations" required />

                <x-form.input-number wireModel="duration" name="duration" label="Duração (dias)" placeholder="Digite a duração do afastamento..." tooltip="Digite a duração do afastamento" isRequired />
                

                <button type="submit" class="w-full py-2 px-4 bg-primary-solid rounded-md border border-borders cursor-pointer">
                    <div wire:loading wire:target="create">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="create" class="text-main-background text-center text-sm font-normal">Registrar</span>
                </button>
            </form>
        </div>
    </div>
</div>