<div class="border-borders bg-main-background flex flex-col gap-3 rounded-lg border p-4">
    <form class="flex flex-col md:flex-row md:items-end gap-3 md:gap-4" wire:submit.prevent="submit">
        <x-new-components.form.select wireModel="group" name="group" label="Dimensão" placeholder="Selecione a dimensão" tooltip="Selecione o setor" :options="$groups" />
        <x-new-components.form.select wireModel="risk_level" name="risk_level" label="Nível de Risco" placeholder="Selecione o nível de risco" :options="$risk_levels" />

        <div class="w-full md:w-fit"> 
            <x-new-components.actions.button type="submit">
                <div wire:loading wire:target="submit">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Filtrar</span>
            </x-new-components.actions.button>
        </div>
    </form>
</div>
