<form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
    <x-form.input-photo wireModel="logo" name="logo" format="w-fit min-w-14 h-14 rounded-md" :value="$logo" tooltip="Clique para trocar a logomarca" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <x-form.input-text wireModel="registerName" name="registerName" label="Razão social" placeholder="Digite a razão social..." value="{{ $company->name }}" tooltip="Digite a razão social" isRequired />
        <x-form.input-text wireModel="email" name="email" label="E-mail" placeholder="Digite o e-mail..." value="{{ $company->email }}" tooltip="Digite o e-mail" isRequired />
        <x-form.input-text wireModel="cnpj" name="cnpj" label="CNPJ" placeholder="Digite o cnpj..." value="{{ $company->cnpj }}" disabled isRequired />

        <x-info-item label="Qtd. de funcionários ativos" :value="$usersCount . ' funcionários'" truncate />
        <x-info-item label="{{ 'Campanha de Riscos Psicossociais ' . now()->year }}" :value="$psychosocialCampaignStatus" truncate />
        <x-info-item label="Facilita Canal de Denúncias" value="{{ $hasReportChannel ? 'Sim' : 'Não' }}" truncate />
    </div>

    <x-actions.button>
        <div wire:loading wire:target="submit">
            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
        </div>

        <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Editar</span>
    </x-actions.button>
</form>