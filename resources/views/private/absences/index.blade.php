<x-layouts.app>
    <x-structure.page-container>
        <x-structure.sidebar />
        
        <x-structure.main-content-container>      
            <x-structure.page-title 
                title="Indicadores Epidemiológicos"
                :breadcrumbs="[
                    'Indicadores Epidemiológicos' => '',
                ]"
            />

            <livewire:private.absences.absence-index-component>

        </x-structure.main-content-container>   
    </x-structure.page-container>
</x-layouts.app>