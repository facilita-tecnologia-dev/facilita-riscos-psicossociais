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

            <div class="w-full flex justify-end gap-4">
                <x-action href="{{ route('dashboard.psychosocial.risks.report') }}" target="_blank" width="fit">
                    Exportar Inventário de Riscos
                </x-action>
            </div>
            
            <livewire:private.control-action-edit-component>
            
        </x-structure.main-content-container>   
    </x-structure.page-container>
</x-layouts.app>