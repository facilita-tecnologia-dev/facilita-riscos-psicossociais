<x-layouts.app>
    <x-structure.page-container>
        <x-structure.sidebar />
        
        <x-structure.main-content-container>   
            <x-structure.page-title 
                :title="$hazard->name" 
                :back="route('dashboard.psychosocial.department', ['hazard' => $hazard])"
                :breadcrumbs="[
                    'Riscos Psicossociais' => route('dashboard.psychosocial'),
                    $hazard->name => '',
                    'Departamentos' => route('dashboard.psychosocial.department', ['hazard' => $hazard]),
                    'Lista de Resultados' => ''
                ]"
            />

            <div class="w-full flex flex-col gap-4">
                <x-structure.message>
                    <i class="fa-solid fa-circle-info"></i>
                    Lista de resultados do risco de {{ trim($hazard->name) }} por colaborador.
                </x-structure.message>
            </div>

            <x-table>
                <x-table.head class="flex items-center gap-3">
                    <x-table.head.sortable-th class="hidden lg:block flex-1" field="department" :queryParam="['hazard' => $hazard, 'department' => $department]">
                        Setor
                    </x-table.head.sortable-th>
                    <x-table.head.sortable-th class="hidden sm:block flex-1" field="occupation" :queryParam="['hazard' => $hazard, 'department' => $department]">
                        Função
                    </x-table.head.sortable-th>
                    <x-table.head.th class="w-40">Nível de Risco</x-table.head.th>
                </x-table.head>
                <x-table.body>
                    @forelse ($list as $user)
                        @if(session('auth:company')->usesHSE())
                            <x-table.body.tr class="
                                    flex items-center gap-3
                                    {{ $user->evaluated == App\Enums\HSE\HSERisk::INTOLERABLE ? 'to-[#F4433675]' : '' }}
                                    {{ $user->evaluated == App\Enums\HSE\HSERisk::SUBSTANTIAL ? 'to-[#FF980075]' : '' }}
                                    {{ $user->evaluated == App\Enums\HSE\HSERisk::MODERATE ? 'to-[#FFC10775]' : '' }}
                                    {{ $user->evaluated == App\Enums\HSE\HSERisk::TOLERABLE ? 'to-[#CDDC3975]' : '' }}
                                    {{ $user->evaluated == App\Enums\HSE\HSERisk::TRIVIAL ? 'to-[#4CAF5075]' : '' }}
                                ">
                                <x-table.body.td class="hidden lg:block flex-1" title="{{ $user->department ?? '(Vazio)'}}">{{ $user->department ?? '(Vazio)'}}</x-table.body.td>
                                <x-table.body.td class="hidden sm:block flex-1" title="{{ $user->occupation ?? '(Vazio)'}}">{{ $user->occupation ?? '(Vazio)'}}</x-table.body.td>
                                <x-table.body.td class="truncate w-40" data-value="{{ $user->evaluated->value }}">{{ $user->evaluated->label() }}</x-table.body.td>
                            </x-table.body.tr>
                        @else
                            <x-table.body.tr class="
                                    flex items-center gap-3
                                    {{ $user->evaluated == App\Enums\PROART\PROARTRisk::CRITICAL ? 'to-[#F26C6C75]' : '' }}
                                    {{ $user->evaluated == App\Enums\PROART\PROARTRisk::HIGH ? 'to-[#F6B26B75]' : '' }}
                                    {{ $user->evaluated == App\Enums\PROART\PROARTRisk::MEDIUM ? 'to-[#DDE26F75]' : '' }}
                                    {{ $user->evaluated == App\Enums\PROART\PROARTRisk::LOW ? 'to-[#A8E6CFCC]' : '' }}
                                ">
                                <x-table.body.td class="hidden lg:block flex-1" title="{{ $user->department ?? '(Vazio)'}}">{{ $user->department ?? '(Vazio)'}}</x-table.body.td>
                                <x-table.body.td class="hidden sm:block flex-1" title="{{ $user->occupation ?? '(Vazio)'}}">{{ $user->occupation ?? '(Vazio)'}}</x-table.body.td>
                                <x-table.body.td class="truncate w-40" data-value="{{ $user->evaluated->value }}">{{ $user->evaluated->label() }}</x-table.body.td>
                            </x-table.body.tr>
                        @endif
                    @empty
                        <p class="w-full text-center mt-6">Não há testes cadastrados.</p>
                    @endforelse
                </x-table.body>
            </x-table>
            
        </x-structure.main-content-container>
    </x-structure.page-container>
</x-layouts.app>