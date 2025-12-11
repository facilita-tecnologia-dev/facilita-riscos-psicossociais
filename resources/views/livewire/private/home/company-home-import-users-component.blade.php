<div class="contents">
    <div class="flex flex-col gap-4">
        <h2 class="text-main-text text-left text-base font-semibold md:text-lg">1. Faça o download do arquivo modelo</h2>

        <p class="text-main-text text-left text-sm font-normal md:text-base">
            O primeiro passo para importar os funcionários é
            <span class="font-semibold">baixar o arquivo modelo</span>
            , que indica as colunas e formatos corretos a serem preenchidos.
        </p>

        <p class="text-main-text text-left text-sm font-normal md:text-base">
            <span class="font-semibold">Não altere o formato dos dados</span>
            , pois isso pode causar erros durante a importação.
        </p>

        <x-actions.button wire:click="downloadTemplate" data-tippy-content="Clique para fazer download do arquivo modelo">
            <div wire:loading wire:target="downloadTemplate">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="downloadTemplate" class="font-heading text-main-background text-center text-sm font-semibold">Fazer download do arquivo modelo</span>
        </x-actions.button>
    </div>

    <form class="flex flex-col gap-4" wire:submit.prevent="submit">
        <h2 class="text-main-text text-left text-base font-semibold md:text-lg">2. Faça upload do arquivo modelo preenchido</h2>

        <x-form.input-file wireModel="importUsersFile" name="importUsersFile" label="Arquivo de importação" placeholder="Selecione o arquivo de importação" tooltip="Selecione o arquivo de importação" :attachments="$importUsersFile" isRequired />

        <div class="grid w-full grid-cols-3 gap-2 sm:gap-4">
            <x-actions.button class="col-span-2">
                <div wire:loading wire:target="submit">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Importar lista de usuários</span>
            </x-actions.button>

            <x-actions.button class="!bg-danger" type="button" wire:click="nextStep">
                <div wire:loading wire:target="nextStep">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="nextStep" class="font-heading text-main-background text-center text-sm font-semibold">Pular etapa</span>
            </x-actions.button>
        </div>
    </form>

    @if ($importErrors)
        <div class="flex flex-col gap-4">
            <h2 class="text-main-text text-left text-base font-semibold md:text-lg">3. Corrija os erros</h2>

            <p class="text-main-text text-left text-sm font-normal md:text-base">Seu arquivo de importação contém erros. Por isso, os colaboradores das linhas com inconsistências não foram importados.</p>

            <ul class="list-disc pl-4">
                @foreach ($importErrors as $error)
                    <li class="text-main-text text-left text-sm font-normal sm:text-base">{{ $error }}</li>
                @endforeach
            </ul>

            <p class="text-main-text text-left text-sm font-semibold sm:text-base">Por favor, corrija esses erros no arquivo de importação e tente novamente.</p>
        </div>
    @endif
</div>
