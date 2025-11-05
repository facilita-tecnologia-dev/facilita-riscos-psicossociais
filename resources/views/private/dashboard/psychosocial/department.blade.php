<x-layouts.app>
    <x-structure.page-container>
        <x-structure.sidebar />
        
        <x-structure.main-content-container>
            <x-structure.page-title 
                :title="$hazard->name" 
                :back="route('dashboard.psychosocial')"
                :breadcrumbs="[
                    'Riscos Psicossociais' => route('dashboard.psychosocial'),
                    $hazard->name => '',
                    'Departamentos' => ''
                ]"
            />

            <x-structure.message>
                <i class="fa-solid fa-circle-info"></i>
                Resultados do risco de {{ trim($hazard->name) }} divididos por setor.
            </x-structure.message>
            
            <div class="w-full grid items-start grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach ($departments as $department => $results)
                    <a class="bg-white/25 rounded-md px-4 py-5 shadow-md">
                        <x-table>
                            <x-table.head class="flex items-center justify-between">
                                <x-table.head.th class="truncate">{{ $department }}</x-table.head.th>
                            </x-table.head>
                            <x-table.body>
                           
                                    @foreach ($results as $riskName => $percentage)
                                        @if(session('auth:company')->usesHSE())
                                            <x-table.body.tr class="
                                                flex items-center justify-between gap-4
                                                {{ $riskName == App\Enums\HSE\HSERisk::INTOLERABLE->label() ? 'to-[#F4433675]' : '' }}
                                                {{ $riskName == App\Enums\HSE\HSERisk::SUBSTANTIAL->label() ? 'to-[#FF980075]' : '' }}
                                                {{ $riskName == App\Enums\HSE\HSERisk::MODERATE->label() ? 'to-[#FFC10775]' : '' }}
                                                {{ $riskName == App\Enums\HSE\HSERisk::TOLERABLE->label() ? 'to-[#CDDC3975]' : '' }}
                                                {{ $riskName == App\Enums\HSE\HSERisk::TRIVIAL->label() ? 'to-[#4CAF5075]' : '' }}
                                            ">
                                                <x-table.body.td class="truncate">{{ $riskName }}</x-table.body.td>
                                                <x-table.body.td>{{ $percentage }}%</x-table.body.td>
                                            </x-table.body.tr>
                                        @else
                                            <x-table.body.tr class="
                                                flex items-center justify-between gap-4
                                                {{ $riskName == App\Enums\PROART\PROARTRisk::CRITICAL->label() ? 'to-[#F26C6C75]' : '' }}
                                                {{ $riskName == App\Enums\PROART\PROARTRisk::HIGH->label() ? 'to-[#F6B26B75]' : '' }}
                                                {{ $riskName == App\Enums\PROART\PROARTRisk::MEDIUM->label() ? 'to-[#DDE26F75]' : '' }}
                                                {{ $riskName == App\Enums\PROART\PROARTRisk::LOW->label() ? 'to-[#A8E6CFCC]' : '' }}
                                            ">
                                                <x-table.body.td class="truncate">{{ $riskName }}</x-table.body.td>
                                                <x-table.body.td>{{ $percentage }}%</x-table.body.td>
                                            </x-table.body.tr>
                                        @endif
                                    @endforeach
                            </x-table.body>
                        </x-table>
                    </a>
                @endforeach
            </div>

        </x-structure.main-content-container>
    </x-structure.page-container>

    
</x-layouts.app>