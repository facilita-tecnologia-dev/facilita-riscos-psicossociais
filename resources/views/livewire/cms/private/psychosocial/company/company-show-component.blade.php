<section class="flex flex-col gap-6 p-4">
    <div class="space-y-3">
        <div class="flex gap-2 items-center">
            <x-icon icon="psychosocial" class="w-6 h-6 object-scale-down text-primary-solid" />
            <h1 class="text-xl md:text-2xl text-main-text font-semibold text-left">Facilita Riscos Psicossociais</h1>
        </div>

        <x-new-components.structure.breadcrumbs 
            :links="[
                'Lista de empresas' => route('cms.psychosocial.company.index'),
                $company->name => null
            ]" 
        />
    </div>

    <livewire:cms.private.psychosocial.company.company-edit-component :company="$company" />

    <div class="w-full space-y-4 lg:col-span-3">
        <div class="bg-secondary-background border-borders flex flex-col items-center gap-2 rounded-lg border px-6 py-4 shadow-sm sm:flex-row">
            <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
                <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">Lista de funcionários</h2>
                <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">Gerencie a lista de funcionários da empresa: crie, importe e edite colaboradores conforme necessário.</span>
            </div>
            <x-new-components.actions.button href="" fitSize>
                <span class="text-main-background font-heading text-center text-sm font-semibold">Lista de funcionários</span>
            </x-new-components.actions.button>
        </div>

        {{-- <div class="bg-secondary-background border-borders flex flex-col items-center gap-2 rounded-lg border px-6 py-4 shadow-sm sm:flex-row">
            <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
                <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">Metodologia de avaliação</h2>
                <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">Selecione a metodologia que será adotada para a avaliação dos riscos psicossociais na empresa.</span>
            </div>

            <form class="w-fit" id="change-metodology" wire:submit.prevent="submit">
                <x-new-components.form.select wireModel="psychosocialMetodology" name="psychosocialMetodology" placeholder="Selecione a metodologia" :options="$psychosocialMetodologies" />
            </form>
        </div> --}}
    </div>

</section>
