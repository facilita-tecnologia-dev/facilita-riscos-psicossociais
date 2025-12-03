<div class="contents">
    <x-new-components.structure.page-header icon="calendar-clock" label="Editar campanha" :breadcrumbs="['Lista de Campanhas' => route('campaign.index'), 'Editar campanha' => null]" />

    <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-start">
            <x-new-components.form.input-text wireModel="name" name="name" label="Nome da Campanha" placeholder="Digite o nome da campanha..." tooltip="Digite o nome da campanha" isRequired />
            <x-new-components.form.input-text wireModel="collection" name="collection" label="Tipo de Campanha" tooltip="Você não pode alterar o tipo da campanha" readonly />
            
            <x-new-components.form.input-datetime wireModel="start_date" name="start_date" label="Data de Início" tooltip="{{ $campaign->start_date->lt(now()->addMinutes(5)) ? 'A campanha começará daqui a pouco, portanto você não pode mais alterar a data de início.' : 'Escolha a data de início da campanha' }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" :readonly="$campaign->start_date->lt(now()->addMinutes(5)) ? true : false" isRequired />
            <x-new-components.form.input-datetime wireModel="end_date" name="end_date" label="Data de Encerramento" tooltip="Escolha a data de encerramento da campanha" min="{{ \Carbon\Carbon::now()->addHours(1)->format('Y-m-d\TH:i') }}" isRequired />
            
            <div class="lg:col-span-2">
                <x-new-components.form.textarea wireModel="description" name="description" label="Descrição da Campanha" placeholder="Digite uma descrição para a campanha..." tooltip="Digite uma descrição para a campanha" />
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <x-new-components.actions.button class="md:col-span-2">
                <div wire:loading wire:target="submit">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Salvar</span>
            </x-new-components.actions.button>

            <x-new-components.actions.button wire:click='deleteCampaign' type="button" class="!bg-danger" :disabled="$campaign->status != App\Enums\CampaignStatus::SCHEDULED">
                <div wire:loading wire:target="deleteCampaign">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="deleteCampaign" class="font-heading text-main-background text-center text-sm font-semibold">Excluir campanha</span>
            </x-new-components.actions.button>
        </div>
    </form>
</div>
