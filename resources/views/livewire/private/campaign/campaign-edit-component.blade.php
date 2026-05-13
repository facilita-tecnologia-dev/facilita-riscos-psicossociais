<div class="contents">
    <x-structure.page-header icon="calendar-clock" label="Editar campanha" :breadcrumbs="['Lista de Campanhas' => route('campaign.index'), 'Editar campanha' => null]" />

    <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-start">
            <x-form.input-text wireModel="name" name="name" label="Nome da Campanha" placeholder="Digite o nome da campanha..." tooltip="Digite o nome da campanha" isRequired />
            <x-form.input-text wireModel="collection" name="collection" label="Tipo de Campanha" tooltip="Você não pode alterar o tipo da campanha" readonly />
            
            <x-form.input-datetime wireModel="start_date" name="start_date" label="Data de Início" tooltip="{{ $campaign->start_date->lt(now()->addMinutes(5)) ? 'A campanha começará daqui a pouco, portanto você não pode mais alterar a data de início.' : 'Escolha a data de início da campanha' }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" :readonly="$campaign->start_date->lt(now()->addMinutes(5)) ? true : false" isRequired />
            <x-form.input-datetime wireModel="end_date" name="end_date" label="Data de Encerramento" tooltip="Escolha a data de encerramento da campanha" min="{{ \Carbon\Carbon::now()->addHours(1)->format('Y-m-d\TH:i') }}" isRequired />
            
            <div class="lg:col-span-2">
                <x-form.textarea wireModel="description" name="description" label="Descrição da Campanha" placeholder="Digite uma descrição para a campanha..." tooltip="Digite uma descrição para a campanha" />
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <x-actions.button class="md:col-span-2">
                <div wire:loading wire:target="submit">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Salvar</span>
            </x-actions.button>

            @if($campaign->status == App\Enums\Campaign\CampaignStatus::SCHEDULED)
                <x-actions.button wire:click='deleteCampaign' type="button" class="!bg-danger">
                    <div wire:loading wire:target="deleteCampaign">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="deleteCampaign" class="font-heading text-main-background text-center text-sm font-semibold">Excluir campanha</span>
                </x-actions.button>
            @else
                <x-actions.button wire:click='completeCampaign' type="button" onclick="confirm('Você deseja finalizar a campanha agora mesmo?')" data-tippy-content="Caso você finalize a campanha agora, ela não poderá ser reaberta e nenhuma nova resposta poderá ser enviada.">
                    <div wire:loading wire:target="completeCampaign">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="completeCampaign" class="font-heading text-main-background text-center text-sm font-semibold">Finalizar campanha</span>
                </x-actions.button>
            @endif
        </div>
    </form>
</div>
 