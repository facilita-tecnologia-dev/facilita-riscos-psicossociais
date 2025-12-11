<div class="contents">
    @if (isset($companies) && count($companies) > 0)
        <div class="w-full flex-1">
            <x-table>
                <x-table.thead class="grid grid-cols-2">
                    <x-table.th>
                        <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Razão Social</span>
                    </x-table.th>
                    <x-table.th class="hidden md:flex">
                        <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">CNPJ</span>
                    </x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    @foreach ($companies as $company)
                        <x-table.tr class="grid grid-cols-2" href="{{ route('cms.report-channel.company.show', $company['id']) }}" last="{{ $loop->last ? true : false }}">
                            <x-table.td>
                                <span class="text-secondary-text font-text truncate text-sm font-normal md:text-base" title="{{ $company['register_name'] }}">{{ $company['register_name'] }}</span>
                            </x-table.td>
                            <x-table.td class="hidden md:flex">
                                <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ $company['cnpj'] }}">{{ $company['cnpj'] }}</span>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </x-table.tbody>
            </x-table>
        </div>
    @else
        <div class="flex w-full items-center justify-center lg:h-full">
            <p class="text-secondary-text font-text text-center text-sm font-normal md:text-base">Nenhuma empresa foi encontrada.</p>
        </div>
    @endif
</div>