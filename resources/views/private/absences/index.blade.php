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

            <div class="w-full flex flex-col md:flex-row gap-2">
                <x-structure.message>
                    <i class="fa-solid fa-circle-info"></i>
                    {{ session('message') ?? 'Devem ser cadastrados afastamentos ocorridos nos últimos 24 meses.' }}
                </x-structure.message>

                <div class="w-full md:w-fit ml-auto">
                    <livewire:private.absences.absence-create-component />
                </div> 
            </div>

            <livewire:private.absences.absence-index-component>

        </x-structure.main-content-container>   
    </x-structure.page-container>
</x-layouts.app>