<div class="contents">
    <x-new-components.structure.page-header icon="brain" label="Indicadores Epidemiológicos" :breadcrumbs="['Indicadores Epidemiológicos' => null]" />

    <div class="w-full flex justify-end">
        @if(session('auth:company')->has_cids)
            <livewire:private.psychosocial.absence.absence-create-component :cids="$cids" />
        @endif
    </div>

    @if(session('auth:company')->has_cids)
        @if ($absences->isNotEmpty())
            <div class="w-full flex-1">
                <x-new-components.table>
                    <x-new-components.table.thead class="grid-cols-[100px_1fr_40px_40px] sm:grid-cols-[156px_1fr_156px_48px_48px] lg:grid-cols-[156px_1fr_1fr_156px_48px_48px] xl:grid-cols-[156px_156px_1fr_1fr_156px_48px_48px]">
                        <x-new-components.table.th class="hidden xl:flex">
                            <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Data de Registro</span>
                        </x-new-components.table.th>
                        <x-new-components.table.th>
                            <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Código CID</span>
                        </x-new-components.table.th>
                        <x-new-components.table.th>
                            <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Setor</span>
                        </x-new-components.table.th>
                        <x-new-components.table.th class="hidden lg:flex">
                            <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Função</span>
                        </x-new-components.table.th>
                        <x-new-components.table.th class="hidden sm:flex">
                            <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Duração</span>
                        </x-new-components.table.th>
                        <x-new-components.table.th></x-new-components.table.th>
                        <x-new-components.table.th></x-new-components.table.th>
                    </x-new-components.table.thead>
                    <x-new-components.table.tbody>
                        @foreach ($absences as $absence)
                            <x-new-components.table.tr class="grid-cols-[100px_1fr_40px_40px] sm:grid-cols-[156px_1fr_156px_48px_48px] lg:grid-cols-[156px_1fr_1fr_156px_48px_48px] xl:grid-cols-[156px_156px_1fr_1fr_156px_48px_48px]" wire:key='absence-row-{{ $absence->id }}' last="{{ $loop->last ? true : false }}">
                                <x-new-components.table.td class="hidden xl:flex">
                                    <span class="text-secondary-text font-text truncate text-sm font-normal md:text-base" title="{{ $absence->created_at->format('d/m/Y') }}">{{ $absence->created_at->format('d/m/Y') }}</span>
                                </x-new-components.table.td>
                                <x-new-components.table.td>
                                    <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ $absence->cid->type }}">{{ $absence->cid->type }}</span>
                                </x-new-components.table.td>
                                <x-new-components.table.td>
                                    <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ $absence->department }}">{{ $absence->department }}</span>
                                </x-new-components.table.td>
                                <x-new-components.table.td class="hidden lg:flex">
                                    <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ $absence->occupation }}">{{ $absence->occupation }}</span>
                                </x-new-components.table.td>
                                <x-new-components.table.td class="hidden sm:flex">
                                    <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ $absence->duration }}">{{ $absence->duration }} dias</span>
                                </x-new-components.table.td>
                                <x-new-components.table.td>
                                    <livewire:private.psychosocial.absence.absence-edit-component wire:key="edit-{{ $absence->id }}" :absence="$absence" :cids="$cids">
                                </x-new-components.table.td>
                                <x-new-components.table.td>
                                    <livewire:private.psychosocial.absence.absence-delete-component wire:key="delete-{{ $absence->id }}" :absence="$absence">
                                </x-new-components.table.td>
                            </x-new-components.table.tr>
                        @endforeach
                    </x-new-components.table.tbody>
                </x-new-components.table>
            </div>
        @else
            <div class="w-full flex flex-col items-center gap-2">
                <img src="{{ asset('assets/registers-not-found.svg') }}" alt="" class="max-w-72">
                <p class="text-base text-center">Você ainda não registrou afastamentos.</p>
            </div>      
        @endif
    @else
        <div class="w-full flex flex-col items-center gap-2">
            <p class="text-base text-center text-secondary-text">Você nos informou que <span class="font-semibold">não tem a informação sobre os afastamentos</span> na empresa nos últimos 24 meses. Caso tenha essa informação e deseje que os afastamentos sejam considerados no cálculo dos riscos psicossociais, acesse o <a class="underline" href="{{ route('company.show', session('auth:company')) }}">perfil da empresa</a> e altere essa configuração.</p>
        </div>        
    @endif
</div>