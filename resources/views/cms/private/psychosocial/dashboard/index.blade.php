<x-layouts.cms>
    <section class="flex flex-col gap-6 p-4">
        <div class="space-y-3">
            <div class="flex gap-2 items-center">
                <x-icon icon="psychosocial" class="w-6 h-6 object-scale-down text-primary-solid" />
                <h1 class="text-2xl text-main-text font-semibold text-left">Facilita Riscos Psicossociais</h1>
            </div>

            <x-new-components.structure.breadcrumbs 
                :links="[
                    'Dashboard' => null,
                ]" 
            />
        </div>

        <x-new-components.actions.button href="">
            <span class="text-main-background text-center text-sm font-semibold">Lista de empresas</span>
        </x-new-components.actions.button>

        <livewire:cms.private.psychosocial.psychosocial-dashboard-component/>
    </section>
</x-layouts.cms>