<section class="flex flex-col gap-6 p-4">
    <div class="space-y-3">
        <div class="flex gap-2 items-center">
            <x-icon icon="psychosocial" class="w-6 h-6 object-scale-down text-primary-solid" />
            <h1 class="text-xl md:text-2xl text-main-text font-semibold text-left">Facilita Riscos Psicossociais</h1>
        </div>

        <x-structure.breadcrumbs 
            :links="[
                'Lista de empresas' => route('cms.psychosocial.company.index'),
                $company->name => route('cms.psychosocial.company.show', $company),
                'Lista de funcionários' => route('cms.psychosocial.user.index', $company),
                'Importar arquivo de funcionários' => null
            ]" 
        />
    </div>

    <div class="w-full grid grid-cols-1 lg:grid-cols-3 items-start gap-4">
        <div class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6">
            <h2 class="text-base md:text-lg text-left font-semibold text-main-text">
                1. Faça o download do arquivo modelo
            </h2>
    
            <p class="text-sm md:text-base text-left text-main-text font-normal">
                O primeiro passo para importar os funcionários é <span class="font-semibold">baixar o arquivo modelo</span>, que indica as colunas e formatos corretos a serem preenchidos.
            </p>
    
            <p class="text-sm md:text-base text-left text-main-text font-normal">
                <span class="font-semibold">Não altere o formato dos dados</span>, pois isso pode causar erros durante a importação.
            </p>
    
            <x-actions.button wire:click='downloadTemplate' data-tippy-content="Clique para fazer download do arquivo modelo">
                <div wire:loading wire:target="downloadTemplate">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>
    
                <span wire:loading.remove wire:target="downloadTemplate" class="font-heading text-main-background text-center text-sm font-semibold">Fazer download do arquivo modelo</span>
            </x-actions.button>
        </div>
    
        <form class="lg:col-span-2 bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="uploadUsersFile">
            <h2 class="text-base md:text-lg text-left font-semibold text-main-text">
                2. Faça upload do arquivo modelo preenchido
            </h2>

            <x-form.input-file wireModel="importUsersFile" name="importUsersFile" label="Arquivo de importação" placeholder="Selecione o arquivo de importação" tooltip="Selecione o arquivo de importação" :attachments="$importUsersFile" isRequired />

            <x-actions.button>
                <div wire:loading wire:target="uploadUsersFile">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>
    
                <span wire:loading.remove wire:target="uploadUsersFile" class="font-heading text-main-background text-center text-sm font-semibold">Importar arquivo</span>
            </x-actions.button>
        </form>

        @if($importErrors)
            <div class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6 lg:col-span-3">
                <h2 class="text-base md:text-lg text-left font-semibold text-main-text">
                    3. Corrija os erros
                </h2>
        
                <p class="text-sm md:text-base text-left text-main-text font-normal">
                    Seu arquivo de importação contém erros. Por isso, os colaboradores das linhas com inconsistências não foram importados.
                </p>
        
                <ul class="list-disc pl-4">
                    @foreach ($importErrors as $error)                 
                        <li class="text-sm sm:text-base text-left text-main-text font-normal">{{ $error }}</li>
                    @endforeach
                </ul>

                <p class="text-sm sm:text-base text-left text-main-text font-semibold">Por favor, corrija esses erros no arquivo de importação e tente novamente.</p>
            </div>
        @endif
    </div>
</section>
