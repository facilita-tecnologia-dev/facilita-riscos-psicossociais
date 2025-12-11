<div class="contents">
    <x-structure.page-header icon="calendar-clock" label="Agendar campanha" :breadcrumbs="['Lista de Campanhas' => route('campaign.index'), 'Agendar campanha' => null]" />

    <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-start">
            <x-form.input-text wireModel="name" name="name" label="Nome da Campanha" placeholder="Digite o nome da campanha..." tooltip="Digite o nome da campanha" isRequired />
            <x-form.select wireModel="collection_id" name="collection_id" label="Tipo de Campanha" placeholder="Selecione o tipo de campanha" tooltip="Selecione o tipo de campanha" :options="$collections" isRequired />
            
            <x-form.input-datetime wireModel="start_date" name="start_date" label="Data de Início" tooltip="Escolha a data de início da campanha" value="{{ \Carbon\Carbon::now()->addMinutes(15)->format('Y-m-d\TH:i') }}"  min="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" isRequired />
            <x-form.input-datetime wireModel="end_date" name="end_date" label="Data de Encerramento" tooltip="Escolha a data de encerramento da campanha" value="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d\TH:i') }}" min="{{ \Carbon\Carbon::now()->addHours(1)->format('Y-m-d\TH:i') }}" isRequired />
            
            <div class="lg:col-span-2">
                <x-form.textarea wireModel="description" name="description" label="Descrição da Campanha" placeholder="Digite uma descrição para a campanha..." tooltip="Digite uma descrição para a campanha" />
            </div>
        </div>

        <x-actions.button>
            <div wire:loading wire:target="submit">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Cadastrar</span>
        </x-actions.button>
    </form>
</div>