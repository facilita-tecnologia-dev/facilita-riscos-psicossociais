<div class="contents">
    @if (isset($users) && count($users) > 0)
        <div class="w-full flex-1">
            <x-table>
                <x-table.thead class="grid grid-cols-2 md:grid-cols-3">
                    <x-table.th>
                        <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Razão Social</span>
                    </x-table.th>
                    <x-table.th class="hidden md:flex">
                        <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">CNPJ</span>
                    </x-table.th>
                    <x-table.th>
                        <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Tipo de usuário</span>
                    </x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    @foreach ($users as $user)
                        <x-table.tr href="{{ route('cms.report-channel.user.show', $user['id']) }}" class="grid grid-cols-2 md:grid-cols-3" last="{{ $loop->last ? true : false }}">
                            <x-table.td>
                                <span class="text-secondary-text font-text truncate text-sm font-normal md:text-base" title="{{ $user['full_name'] }}">{{ $user['full_name'] }}</span>
                            </x-table.td>
                            <x-table.td class="hidden md:flex">
                                <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ $user['cpf'] }}">{{ $user['cpf'] }}</span>
                            </x-table.td>
                            <x-table.td>
                                <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ App\Enums\ReportChannel\ReportChannelUserTypes::from($user['type'])->label() }}">{{ App\Enums\ReportChannel\ReportChannelUserTypes::from($user['type'])->label() }}</span>
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