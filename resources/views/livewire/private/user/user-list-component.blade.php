<div class="contents">
    {{-- @php
        $latestPsychosocialCampaign = session("auth:company")->latestPsychosocialCampaign();
        $latestOrganizationalCampaign = session("auth:company")->latestOrganizationalCampaign();
    @endphp --}}
    @if (isset($users) && count($users) > 0)
        <div class="w-full flex-1">
            <x-new-components.table>
                <x-new-components.table.thead class="grid-cols-[1fr_64px_64px] xl:grid-cols-[1fr_1fr_64px_64px]">
                    <x-new-components.table.th>
                        <span class="block text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Nome</span>
                    </x-new-components.table.th>
                    <x-new-components.table.th class="hidden xl:flex">
                        <span class="block text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Setor</span>
                    </x-new-components.table.th>
                    <x-new-components.table.th>
                        <x-icon icon="brain" class="text-main-text h-6 w-6 object-scale-down" />
                    </x-new-components.table.th>
                    <x-new-components.table.th>
                        <x-icon icon="cloud" class="text-main-text h-6 w-6 object-scale-down" />
                    </x-new-components.table.th>
                </x-new-components.table.thead>
                <x-new-components.table.tbody>
                    @foreach ($users as $user)
                        <x-new-components.table.tr class="grid-cols-[1fr_64px_64px] xl:grid-cols-[1fr_1fr_64px_64px]" href="{{ route('user.show', $user) }}" last="{{ $loop->last ? true : false }}">
                            <x-new-components.table.td>
                                <span class="text-secondary-text font-text truncate text-sm font-normal md:text-base" title="{{ $user->name }}">{{ $user->name }}</span>
                            </x-new-components.table.td>
                            <x-new-components.table.td class="hidden xl:flex">
                                <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ $user->department }}">{{ $user->department }}</span>
                            </x-new-components.table.td>
                            <x-new-components.table.td>
                                <x-icon icon="{{ $user->hasAnsweredPsychosocial ? 'check' : 'x-mark' }}" class="text-main-text h-6 w-6 object-scale-down" />
                            </x-new-components.table.td>
                            <x-new-components.table.td>
                                <x-icon icon="{{ $user->hasAnsweredOrganizational ? 'check' : 'x-mark' }}" class="text-main-text h-6 w-6 object-scale-down" />
                            </x-new-components.table.td>
                        </x-new-components.table.tr>
                    @endforeach
                </x-new-components.table.tbody>
            </x-new-components.table>
        </div>
    @else
        <div class="flex w-full items-center justify-center lg:h-full">
            <p class="text-secondary-text font-text text-center text-sm font-normal md:text-base">Nenhum usuário foi encontrado.</p>
        </div>
    @endif
</div>