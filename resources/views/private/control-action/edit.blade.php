<x-layouts.app>
    <x-structure.page-container>
        <x-structure.sidebar />
        
        <x-structure.main-content-container>      
            <x-structure.page-title 
                title="Medidas de Controle"
                :breadcrumbs="[
                    'Medidas de Controle' => '',
                ]"
            />

            <div class="w-full flex flex-col md:justify-end md:flex-row gap-4">
                @cannot('action-plan-edit')
                    <x-structure.message>
                        <i class="fa-solid fa-circle-info"></i>
                        Você só poderá exportar o Inventário de Riscos Psicossociais após ter uma campanha finalizada.
                    </x-structure.message>
                @endcannot

                <div class="w-full md:w-fit">
                    @can('action-plan-edit')
                        <livewire:private.action-plan.generate-report-component>
                    @endcan
                </div>
            </div>

            
            <livewire:private.action-plan.control-action-edit-component>
            
        </x-structure.main-content-container>   
    </x-structure.page-container>
</x-layouts.app>