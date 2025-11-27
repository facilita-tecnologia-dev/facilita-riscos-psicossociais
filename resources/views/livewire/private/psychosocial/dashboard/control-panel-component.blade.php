<div class="border-borders bg-main-background flex flex-col gap-4 rounded-lg border p-4">
    <header class="flex items-center justify-between">
        <h2 class="text-main-text font-heading text-left text-lg font-semibold">Painel de Controle</h2>

        <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Neste card, você pode controlar como deseja visualizar o seu dashboard. Os dados serão exibidos conforme os filtros que você selecionar.">
            <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
        </div>
    </header>

    <form class="grid w-full grid-cols-1 gap-4" wire:submit.prevent="submit">
        <x-new-components.form.input-binary wireModel="role" name="role" label="Tipo de Avaliação" tooltip="Escolha o tipo de avaliação" :options="[['label' => 'Setor', 'value' => 'department'], ['label' => 'Função', 'value' => 'occupation']]" isRequired />

        <x-new-components.form.select wireModel="department" name="department" label="Setor" placeholder="Selecione o setor" tooltip="Selecione o setor" :options="[['label' => 'Setor 1', 'value' => '1'], ['label' => 'Setor 2', 'value' => '2']]" isRequired />
        {{-- <x-new-components.form.select wireModel="occupation" name="occupation" label="Função" placeholder="Selecione a função" tooltip="Selecione a função" :options="[['label' => 'Função 1', 'value' => '1'], ['label' => 'Função 2', 'value' => '2']]" isRequired /> --}}

        <x-new-components.actions.button class="w-full" type="submit">
            <div wire:loading wire:target="submit">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Login</span>
        </x-new-components.actions.button>
    </form>
</div>
