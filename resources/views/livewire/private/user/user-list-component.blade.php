<div class="contents">
    <div class="space-y-2">
        <div class="bg-borders px-4 py-1 rounded-md w-fit">
            <span class="text-sm text-left text-main-text font-normal">
                {{ isset($users) && count($users) > 0 ? count($users) : 0 }} funcionários encontrados
            </span>
        </div>
        @if(count($filters) > 0)
            <div class="bg-borders px-4 py-1 rounded-md max-w-full min-w-0">
                <span class="text-sm text-left text-main-text font-normal truncate block">
                    <strong>Filtros aplicados: </strong>
                    @foreach (array_filter($filters) as $filterName => $filterValue)
                        @if($filterName == 'name') Nome: {{ $filterValue }} @endif
                        @if($filterName == 'department') Setor: {{ $filterValue }} @endif
                        @if($filterName == 'status') Status: {{ App\Enums\User\UserStatus::from($filterValue)->label() }} @endif
                        @if($filterName == 'has_answered_psychosocial_campaign') Respondeu Psicossocial: {{ $filterValue == '0' ? 'Não' : 'Sim' }} @endif
                        @if($filterName == 'has_answered_organizational_campaign') Respondeu Pesquisa de Clima: {{ $filterValue == '0' ? 'Não' : 'Sim' }} @endif
                        @if($filterName == 'orderBy') Ordenação: {{ App\Enums\Psychosocial\UserOrder::from($filterValue)->label() }} @endif
                        @if(!$loop->last), @endif
                    @endforeach
                </span>
            </div>
        @endif
    </div>

    @if (isset($users) && count($users) > 0)
        <div class="w-full flex-1">
            <x-table>
                <x-table.thead class="{{ session('auth:company')->can_access_organizational ? 'grid-cols-[1fr_64px_64px_32px] xl:grid-cols-[1fr_1fr_64px_64px_32px]' : 'grid-cols-[1fr_64px_32px] xl:grid-cols-[1fr_1fr_64px_32px]' }}">
                    <x-table.th>
                        <span class="block text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Nome</span>
                    </x-table.th>
                    <x-table.th class="hidden xl:flex">
                        <span class="block text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Setor</span>
                    </x-table.th>
                    <x-table.th>
                        <x-icon icon="brain" class="text-main-text h-6 w-6 object-scale-down" />
                    </x-table.th>
                    @if(session('auth:company')->can_access_organizational)
                        <x-table.th>
                            <x-icon icon="cloud" class="text-main-text h-6 w-6 object-scale-down" />
                        </x-table.th>
                    @endif
                    <x-table.th>
                            <x-icon icon="user-check" class="text-main-text h-6 w-6 object-scale-down" />
                    </x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    @foreach ($users as $user)
                        <x-table.tr class="{{ session('auth:company')->can_access_organizational ? 'grid-cols-[1fr_64px_64px_32px] xl:grid-cols-[1fr_1fr_64px_64px_32px]' : 'grid-cols-[1fr_64px_32px] xl:grid-cols-[1fr_1fr_64px_32px]' }}" href="{{ route('user.show', $user) }}" last="{{ $loop->last ? true : false }}">
                            <x-table.td>
                                <span class="text-secondary-text font-text truncate text-sm font-normal md:text-base" title="{{ $user->name }}">{{ $user->name }}</span>
                            </x-table.td>
                            <x-table.td class="hidden xl:flex">
                                <span class="text-secondary-text text-left font-text truncate text-sm font-normal md:text-base" title="{{ $user->department }}">{{ $user->department }}</span>
                            </x-table.td>
                            <x-table.td>
                                <x-icon icon="{{ $user->hasAnsweredPsychosocial ? 'check' : 'x-mark' }}" class="text-main-text h-6 w-6 object-scale-down" />
                            </x-table.td>
                            @if(session('auth:company')->can_access_organizational)
                                <x-table.td>
                                    <x-icon icon="{{ $user->hasAnsweredOrganizational ? 'check' : 'x-mark' }}" class="text-main-text h-6 w-6 object-scale-down" />
                                </x-table.td>
                            @endif
                            <x-table.td>
                                @if($user->status === App\Enums\User\UserStatus::ACTIVE)
                                    <div class="w-2.5 h-2.5 rounded-full bg-success ">
                                        <div class="w-2.5 h-2.5 rounded-full bg-success animate-ping"></div>
                                    </div>
                                @else
                                    <div class="w-2.5 h-2.5 rounded-full bg-danger ">
                                        <div class="w-2.5 h-2.5 rounded-full bg-danger animate-ping"></div>
                                    </div>
                                @endif
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </x-table.tbody>
            </x-table>
        </div>
    @else
        <div class="flex w-full items-center justify-center lg:h-full">
            <p class="text-secondary-text font-text text-center text-sm font-normal md:text-base">Nenhum usuário foi encontrado.</p>
        </div>
    @endif
</div>