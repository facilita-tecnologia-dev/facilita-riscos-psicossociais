<div class="contents">
    @if (isset($companies) && count($companies) > 0)
        <div class="w-full flex-1">
            <x-new-components.table>
                <x-new-components.table.thead class="grid-cols-[minmax(0,1fr)_48px_48px] md:grid-cols-[minmax(0,1fr)_minmax(0,1fr)_72px_72px]">
                    <x-new-components.table.th>
                        <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Razão Social</span>
                    </x-new-components.table.th>
                    <x-new-components.table.th class="hidden md:flex">
                        <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">CNPJ</span>
                    </x-new-components.table.th>
                    <x-new-components.table.th>
                        <x-icon icon="check-user" class="w-6 h-6 object-scale-down text-secondary-text" data-tippy-content="Essa coluna mostra a quantidade de usuários ativos da empresa"/>
                    </x-new-components.table.th>
                    <x-new-components.table.th>
                        <x-icon icon="brain" class="w-6 h-6 object-scale-down text-secondary-text" data-tippy-content="Essa coluna mostra o status da Campanha de Riscos Psicossociais da empresa no ano atual"/>
                    </x-new-components.table.th>
                </x-new-components.table.thead>
                <x-new-components.table.tbody>
                    @foreach ($companies as $company)
                        <x-new-components.table.tr class="grid-cols-[minmax(0,1fr)_48px_48px] md:grid-cols-[minmax(0,1fr)_minmax(0,1fr)_72px_72px]" href="{{ route('cms.psychosocial.company.show', $company) }}" last="{{ $loop->last ? true : false }}">
                            <x-new-components.table.td>
                                <span class="text-secondary-text font-text truncate text-sm font-normal md:text-base" title="{{ $company->name }}">{{ $company->name }}</span>
                            </x-new-components.table.td>
                            <x-new-components.table.td class="hidden md:flex">
                                <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ $company->cnpj }}">{{ $company->cnpj }}</span>
                            </x-new-components.table.td>
                            <x-new-components.table.td>
                                <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ $company->users_count }}">{{ $company->users_count }}</span>
                            </x-new-components.table.td>
                            <x-new-components.table.td>
                                <x-icon icon="{{ 
                                        $company->latestPsychosocialCampaign()->start_date->year == now()->year 
                                            ? $company->latestPsychosocialCampaign()->status->icon()
                                            : 'x-mark'
                                }}" />
                            </x-new-components.table.td>
                        </x-new-components.table.tr>
                    @endforeach
                </x-new-components.table.tbody>
            </x-new-components.table>
        </div>
    @else
        <div class="flex w-full items-center justify-center lg:h-full">
            <p class="text-secondary-text font-text text-center text-sm font-normal md:text-base">Nenhuma empresa foi encontrada.</p>
        </div>
    @endif
</div>