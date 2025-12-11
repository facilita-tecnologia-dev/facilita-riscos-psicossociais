<form class="flex flex-col gap-4" wire:submit.prevent="submit">
    <div class="grid grid-cols-1 items-start gap-x-4 gap-y-3 sm:grid-cols-2">
        <x-form.input-text wireModel="name" name="name" label="Nome da Campanha" placeholder="Digite o nome da campanha..." tooltip="Digite o nome da campanha" isRequired />
        <x-form.select wireModel="collection_id" name="collection_id" label="Formulário de Pesquisa" placeholder="Escolha o formulário de pesquisa..." tooltip="Escolha o formulário de pesquisa" :options="$collections" isRequired />
        <x-form.input-datetime wireModel="start_date" name="start_date" label="Data de Início" placeholder="Escolha a data de início" tooltip="Escolha a data de início" isRequired />
        <x-form.input-datetime wireModel="end_date" name="end_date" label="Data de Encerramento" placeholder="Escolha a data de encerramento" tooltip="Escolha a data de encerramento" isRequired />

        <div class="sm:col-span-2">
            <x-form.textarea wireModel="description" name="description" label="Descrição" placeholder="Digite a descrição..." tooltip="Digite a descrição" />
        </div>
    </div>

    <div class="grid w-full grid-cols-3 gap-4">
        <x-actions.button class="col-span-2">
            <div wire:loading wire:target="submit">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Agendar campanha</span>
        </x-actions.button>

        <x-actions.button class="!bg-danger" type="button" wire:click="nextStep">
            <div wire:loading wire:target="nextStep">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="nextStep" class="font-heading text-main-background text-center text-sm font-semibold">Pular etapa</span>
        </x-actions.button>
    </div>
</form>
