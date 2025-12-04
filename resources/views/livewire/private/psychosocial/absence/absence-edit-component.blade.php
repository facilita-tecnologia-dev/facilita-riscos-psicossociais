<div x-data="{ absenceEditModalOpen: false }">
    <button @click="absenceEditModalOpen = true" class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-sm transition hover:bg-borders text-secondary-text border-borders border bg-transparent" data-tippy-content="Editar afastamento">
        <x-icon icon="pencil" class="h-5 w-5 object-scale-down text-inherit" />
    </button>

    <div x-show="absenceEditModalOpen" x-on:absence:updated.window="absenceEditModalOpen = false" x-cloak @click.self="absenceEditModalOpen = false" x-transition.opacity class="fixed inset-0 z-30 flex items-center justify-center bg-black/60 px-4">
        <div class="bg-secondary-background border-borders flex flex-col gap-4 w-full max-w-xl rounded-lg border p-6 shadow-sm">
            <header class="flex w-full items-center justify-between">
                <h2 class="font-heading text-main-text text-left text-base sm:text-lg font-semibold">Editar afastamento</h2>

                <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Neste modal, você pode editar um afastamento anteriormente cadastrado pela empresa.">
                    <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                </div>
            </header>

            <form class="w-full space-y-4" wire:submit.prevent="update">                
                <x-new-components.form.select wireModel="cid" name="cid" label="Código CID" placeholder="Selecione o código CID" tooltip="Selecione o Código CID" :options="$cids" required />
                <x-new-components.form.select wireModel="department" name="department" label="Setor" placeholder="Selecione o setor" tooltip="Selecione o setor" :options="$departments" required />
                <x-new-components.form.select wireModel="occupation" name="occupation" label="Função" placeholder="Selecione a função" tooltip="Selecione a função" :options="$occupations" required />

                <x-new-components.form.input-number wireModel="duration" name="duration" label="Duração (dias)" placeholder="Digite a duração do afastamento..." tooltip="Digite a duração do afastamento" isRequired />
                

                <button type="submit" class="w-full py-2 px-4 bg-primary-solid rounded-md border border-borders cursor-pointer">
                    <div wire:loading wire:target="update">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="update" class="text-main-background text-center text-sm font-normal">Salvar</span>
                </button>
            </form>
        </div>
    </div>
</div>