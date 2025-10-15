<x-layouts.app>
    <x-structure.page-container>
        <x-structure.sidebar />
        
        <x-structure.main-content-container>      
            <x-structure.page-title 
                title="Indicadores Epidemiológicos"
                :breadcrumbs="[
                    'Indicadores Epidemiológicos' => route('company-absence.index'),
                    'Editar afastamento' => ''
                ]"
            />

            <livewire:private.absences.absence-edit-component>

        </x-structure.main-content-container>   
    </x-structure.page-container>
</x-layouts.app>