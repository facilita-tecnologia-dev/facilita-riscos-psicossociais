<div class="contents">

    <div class="w-full flex flex-col md:flex-row gap-2">
        <x-structure.message>
            <i class="fa-solid fa-circle-info"></i>
            {{ session('message') ?? ($company->has_cids ? 'Devem ser cadastrados afastamentos ocorridos nos últimos 24 meses.' : 'Você nos informou que não tem informações sobre os afastamentos.' )}}
        </x-structure.message>
        
        @if($company->has_cids)
            <div class="w-full md:w-fit ml-auto">
                <x-action id="toggleFalse" tag="button" variant="danger" width="full" wire:click='toggleAbsenceConfig' data-tippy-content="Clique aqui caso não tenha informação sobre os afastamentos ocorridos nos últimos 24 meses na sua empresa. Nesse caso, os afastamentos não serão considerados no cálculo de riscos psicossociais.">
                    Não tenho essa informação
                </x-action>
            </div>
        @else
            <div class="w-full md:w-fit ml-auto">
                <x-action id="toggleTrue" tag="button" width="full" wire:click='toggleAbsenceConfig' data-tippy-content="Clique aqui se tiver informações sobre os afastamentos ocorridos nos últimos 24 meses na sua empresa. Caso ative essa opção, poderá cadastrar afastamentos da empresa">
                    Tenho essa informação
                </x-action>
            </div>
        @endif
        
        @if($company->has_cids)
            <div class="w-full md:w-fit ml-auto">
                <livewire:private.absences.absence-create-component />
            </div> 
        @endif
    </div>

    @if($company->has_cids)
        @if($absences->isNotEmpty())
            <x-table class="flex flex-col gap-1">
                <x-table.head class="flex items-center gap-3">
                    <x-table.head.th class="hidden lg:block w-40">
                        Data de Registro
                    </x-table.head.th>
                    <x-table.head.th class="flex-1 sm:w-36">
                        Código CID
                    </x-table.head.th>
                    <x-table.head.th class="hidden md:block flex-1">
                        Setor
                    </x-table.head.th>
                    <x-table.head.th class="hidden sm:block flex-1">
                        Função
                    </x-table.head.th>
                    <x-table.head.th class="flex-1 sm:w-28">
                        Duração
                    </x-table.head.th>
                    <x-table.head.th class="w-12"></x-table.head.th>
                    <x-table.head.th class="w-12"></x-table.head.th>
                </x-table.head>
                <x-table.body>
                    @foreach ($absences as $absence)
                        <x-table.body.tr class="flex items-center gap-3" wire:key="absence-row-{{ $absence->id }}">
                            <x-table.body.td class="hidden lg:block w-40 truncate">{{ $absence->created_at->format('d/m/Y') }}</x-table.body.td>
                            <x-table.body.td class="flex-1 sm:w-36 truncate">{{ $absence->cid->type }}</x-table.body.td>
                            <x-table.body.td class="hidden md:block flex-1 truncate">{{ $absence->department }}</x-table.body.td>
                            <x-table.body.td class="hidden sm:block flex-1 truncate">{{ $absence->occupation }}</x-table.body.td>
                            <x-table.body.td class="flex-1 sm:w-28">{{ $absence->duration }} dias</x-table.body.td>
                            <x-table.body.td class="w-12">
                                <livewire:private.absences.absence-edit-component wire:key="edit-{{ $absence->id }}" :absence="$absence" :cids="$cids">
                            </x-table.body.td>
                            <x-table.body.td class="w-12">
                                <livewire:private.absences.absence-delete-component wire:key="delete-{{ $absence->id }}" :absence="$absence">
                            </x-table.body.td>
                        </x-table.body.tr>
                    @endforeach
                </x-table.body>
            </x-table>

            {{ $absences->links('vendor.pagination.tailwind') }}
        @else
            <div class="w-full flex flex-col items-center gap-2">
                <img src="{{ asset('assets/registers-not-found.svg') }}" alt="" class="max-w-72">
                <p class="text-base text-center">Você ainda não registrou afastamentos.</p>
            </div>         
        @endif
    @else
        <div class="w-full flex flex-col items-center gap-2">
            <p class="text-base text-center">Você nos informou que <span class="font-semibold">não tem a informação sobre os afastamentos</span> na empresa nos últimos 24 meses. Caso tenha essa informação e deseje que os afastamentos sejam considerados no cálculo dos riscos psicossociais, <button class="underline cursor-pointer" wire:click='toggleAbsenceConfig'>clique aqui</button></p>
        </div>        
    @endif
</div>