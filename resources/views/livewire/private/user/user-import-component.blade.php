<div class="contents">
    <x-structure.page-header icon="users" label="Importar Funcionários" :breadcrumbs="['Página da Empresa' => route('company.show', session('auth:company')), 'Lista de Funcionários' => route('user.index'), 'Importar Funcionários' => null]" />

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

            <x-form.input-file wireModel="import_users_file" name="import_users_file" label="Arquivo de importação" placeholder="Selecione o arquivo de importação" tooltip="Selecione o arquivo de importação" :attachments="$import_users_file" isRequired />

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
</div>