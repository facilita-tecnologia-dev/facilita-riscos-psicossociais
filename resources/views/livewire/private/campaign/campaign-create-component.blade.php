<div class="contents">
    <x-structure.page-header icon="calendar-clock" label="Agendar campanha" :breadcrumbs="['Lista de Campanhas' => route('campaign.index'), 'Agendar campanha' => null]" />

    <div class="bg-main-background border-borders flex flex-col gap-3 rounded-lg border p-4">
        <p class="text-main-text text-left text-sm font-normal md:text-base">
            Uma campanha define o <span class="font-semibold">período em que os funcionários responderão aos questionários</span>. Você escolhe o tipo de avaliação, as datas de início e encerramento, e ao longo da campanha os resultados são consolidados automaticamente no dashboard.
        </p>
        @if(session('auth:company')->can_access_organizational)
            <div class="flex flex-col gap-1.5 pt-1">
                <p class="text-main-text text-left text-xs font-semibold uppercase tracking-wide">Tipos de campanha:</p>
                <ul class="flex flex-col gap-1.5">
                    <li class="flex items-start gap-2 text-sm text-main-text font-normal">
                        <x-icon icon="brain" class="text-primary-solid h-4 w-4 object-scale-down shrink-0 mt-0.5" />
                        <span><span class="font-semibold">Riscos Psicossociais</span> — avalia perigos do ambiente de trabalho que afetam a saúde mental dos funcionários</span>
                    </li>
                    <li class="flex items-start gap-2 text-sm text-main-text font-normal">
                        <x-icon icon="cloud" class="text-primary-solid h-4 w-4 object-scale-down shrink-0 mt-0.5" />
                        <span><span class="font-semibold">Clima Organizacional</span> — mede a percepção dos funcionários sobre liderança, comunicação e cultura da empresa</span>
                    </li>
                </ul>
            </div>
        @endif
    </div>

    <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-start">
            <x-form.input-text wireModel="name" name="name" label="Nome da Campanha" placeholder="Digite o nome da campanha..." tooltip="Digite o nome da campanha" isRequired />
            <x-form.select wireModel="collection_id" name="collection_id" label="Tipo de Campanha" placeholder="Selecione o tipo de campanha" tooltip="Selecione o tipo de campanha" :options="$collections" isRequired />
            
            <x-form.input-datetime wireModel="start_date" name="start_date" label="Data de Início" tooltip="Escolha a data de início da campanha" isRequired />
            <x-form.input-datetime wireModel="end_date" name="end_date" label="Data de Encerramento" tooltip="Escolha a data de encerramento da campanha" isRequired />
            
            <div class="lg:col-span-2">
                <x-form.textarea wireModel="description" name="description" label="Descrição da Campanha" placeholder="Digite uma descrição para a campanha..." tooltip="Digite uma descrição para a campanha" />
            </div>
        </div>

        <x-actions.button>
            <div wire:loading wire:target="submit">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Agendar</span>
        </x-actions.button>
    </form>
</div>