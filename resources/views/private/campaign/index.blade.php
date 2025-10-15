<x-layouts.app>
    <x-structure.page-container>
        <x-structure.sidebar />
        
        <x-structure.main-content-container>
            <x-structure.page-title 
                title="Lista de Campanhas" 
                :breadcrumbs="[
                    'Lista de Campanhas' => '',
                ]"
            />

            @if(session('message'))
                <x-structure.message>
                    <i class="fa-solid fa-circle-info"></i>
                    {{ session('message') }}
                </x-structure.message>
            @elseif(session('auth:company')->hasCampaignThisYear(session('auth:company')->psychosocialCollection()->id, App\Enums\CampaignStatus::IN_PROGRESS->value))
                <x-structure.message>
                    <i class="fa-solid fa-circle-info"></i>
                    O Plano de Ação só poderá ser acessado e editado após a finalização da campanha de Riscos Psicossociais.
                </x-structure.message>
            @endif
            
            @can('campaign-create')
                <div class="w-full flex justify-end flex-col-reverse md:flex-row items-start gap-2">
                    <div class="w-full md:w-fit flex gap-2">
                        <div class="w-full md:w-fit">
                            <x-action href="{{ route('campaign.create') }}" width="full">
                                <i class="fa-solid fa-plus text-sm sm:text-base"></i>
                            </x-action>
                        </div>
                    </div>
                </div>
            @endcan
                
            @if(session('auth:company')->campaigns->isNotEmpty())
                <x-table class="flex flex-col gap-1">
                    <x-table.head class="flex items-center gap-3">
                        <x-table.head.sortable-th class="flex-1" field="name">
                            Nome
                        </x-table.head.sortable-th>
                        <x-table.head.sortable-th class="hidden md:block flex-1" field="start_date">
                            Início
                        </x-table.head.sortable-th>
                        <x-table.head.sortable-th class="hidden md:block flex-1" field="end_date">
                            Encerramento
                        </x-table.head.sortable-th>
                        <x-table.head.sortable-th class="w-32" field="end_date">
                            Status
                        </x-table.head.sortable-th>
                    </x-table.head>
                    <x-table.body>
                        @foreach ($campaigns as $campaign)
                            <x-table.body.tr tag="a" href="{{ route('campaign.show', $campaign) }}" class="flex items-center gap-3" >
                                <x-table.body.td class="truncate flex-1">{{ $campaign->name }}</x-table.body.td>
                                <x-table.body.td class="hidden md:block truncate flex-1">{{ $campaign->start_date->format('d/m/Y - H:i') }}</x-table.body.td>
                                <x-table.body.td class="hidden md:block truncate flex-1">{{ $campaign->end_date->format('d/m/Y - H:i') }}</x-table.body.td>
                                <x-table.body.td class="truncate w-32">{{ $campaign->status->label() }}</x-table.body.td>                                
                            </x-table.body.tr>
                        @endforeach
                    </x-table.body>
                </x-table>

                {{ $campaigns->links() }}
            @else
                <div class="w-full flex flex-col items-center gap-2">
                    <img src="{{ asset('assets/registers-not-found.svg') }}" alt="" class="max-w-72">
                    <p class="text-base text-center">Você ainda não agendou campanhas.</p>
                </div>         
            @endif
        </x-structure.main-content-container>
    </x-structure.page-container>
</x-layouts.app>


