<div class="contents">
    @if (isset($companies) && count($companies) > 0)
        <div class="w-full flex-1">
            <x-new-components.table>
                <x-new-components.table.thead class="grid grid-cols-2">
                    <x-new-components.table.th>
                        <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Razão Social</span>
                    </x-new-components.table.th>
                    <x-new-components.table.th class="hidden md:flex">
                        <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">CNPJ</span>
                    </x-new-components.table.th>
                </x-new-components.table.thead>
                <x-new-components.table.tbody>
                    @foreach ($companies as $company)
                        <x-new-components.table.tr class="grid grid-cols-2" last="{{ $loop->last ? true : false }}">
                            <x-new-components.table.td>
                                <span class="text-secondary-text font-text truncate text-sm font-normal md:text-base" title="{{ $company['register_name'] }}">{{ $company['register_name'] }}</span>
                            </x-new-components.table.td>
                            <x-new-components.table.td class="hidden md:flex">
                                <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ $company['cnpj'] }}">{{ $company['cnpj'] }}</span>
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