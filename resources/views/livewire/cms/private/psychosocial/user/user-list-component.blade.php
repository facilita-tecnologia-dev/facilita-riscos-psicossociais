<div class="contents">
    @if (isset($users) && count($users) > 0)
        <div class="w-full flex-1">
            <x-new-components.table>
                <x-new-components.table.thead class="grid-cols-2 sm:grid-cols-3">
                    <x-new-components.table.th>
                        <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Nome</span>
                    </x-new-components.table.th>
                    <x-new-components.table.th class="hidden sm:flex">
                        <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">CPF</span>
                    </x-new-components.table.th>
                    <x-new-components.table.th>
                        <span class="text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Setor</span>
                    </x-new-components.table.th>
                </x-new-components.table.thead>
                <x-new-components.table.tbody>
                    @foreach ($users as $user)
                        <x-new-components.table.tr class="grid-cols-2 sm:grid-cols-3" href="{{ route('cms.psychosocial.user.show', ['company' => $company, 'user' => $user]) }}" last="{{ $loop->last ? true : false }}">
                            <x-new-components.table.td>
                                <span class="text-secondary-text font-text truncate text-sm font-normal md:text-base" title="{{ $user->name }}">{{ $user->name }}</span>
                            </x-new-components.table.td>
                            <x-new-components.table.td class="hidden sm:flex">
                                <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ $user->cpf }}">{{ $user->cpf }}</span>
                            </x-new-components.table.td>
                            <x-new-components.table.td>
                                <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ $user->department }}">{{ $user->department }}</span>
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