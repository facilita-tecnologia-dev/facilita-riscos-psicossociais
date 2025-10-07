<x-layouts.app>
    <x-structure.page-container>
        <x-structure.sidebar />
        
        <x-structure.main-content-container>   
            <x-structure.page-title 
                :title="$risk->name" 
                :back="route('dashboard.psychosocial.department', ['risk' => $risk])"
                :breadcrumbs="[
                    'Riscos Psicossociais' => route('dashboard.psychosocial'),
                    $risk->name => '',
                    'Departamentos' => route('dashboard.psychosocial.department', ['risk' => $risk]),
                    'Lista de Resultados' => ''
                ]"
            />

            <div class="w-full flex flex-col gap-4">
                <x-structure.message>
                    <i class="fa-solid fa-circle-info"></i>
                    Lista de resultados do risco de {{ trim($risk->name) }} por colaborador.
                </x-structure.message>
            </div>

            <x-table>
                <x-table.head class="flex items-center gap-3">
                    <x-table.head.sortable-th class="hidden lg:block flex-1" field="department" :queryParam="['risk' => $risk, 'department' => $department]">
                        Setor
                    </x-table.head.sortable-th>
                    <x-table.head.sortable-th class="hidden sm:block flex-1" field="occupation" :queryParam="['risk' => $risk, 'department' => $department]">
                        Função
                    </x-table.head.sortable-th>
                    <x-table.head.th class="w-40">Nível de Risco</x-table.head.th>
                </x-table.head>
                <x-table.body>
                    @forelse ($list as $user)
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
                    @empty
                        <p class="w-full text-center mt-6">Não há testes cadastrados.</p>
                    @endforelse
                </x-table.body>
            </x-table>
            
        </x-structure.main-content-container>
    </x-structure.page-container>
</x-layouts.app>