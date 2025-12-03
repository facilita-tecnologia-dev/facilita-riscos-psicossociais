<div class="contents">
    <livewire:private.company.company-edit-component :company="$company" />

    <div class="w-full flex flex-col gap-4">
        <div class="bg-secondary-background border-borders flex flex-col items-center gap-2 rounded-lg border px-6 py-4 shadow-sm sm:flex-row">
            <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
                <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">Lista de funcionários</h2>
                <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">Gerencie a lista de funcionários da empresa: crie, importe e edite colaboradores conforme necessário.</span>
            </div>

            <x-new-components.actions.button href="{{ route('user.index') }}" fitSize>
                <span class="text-main-background font-heading text-center text-sm font-semibold">Lista de funcionários</span>
            </x-new-components.actions.button>
        </div>

        <livewire:private.company.company-reset-password-component />

        <livewire:private.company.company-cid-config-component />
    </div>
</div>