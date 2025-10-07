<x-layouts.app>
    <x-structure.page-container>
        <x-structure.sidebar />
        
        <x-structure.main-content-container>
            <x-structure.page-title title="Riscos Psicossociais" :back="route('dashboard.psychosocial')" />

            <div class="w-full flex flex-col md:flex-row gap-4">
                <x-structure.message>
                    <i class="fa-solid fa-circle-info"></i>
                    Resultado detalhado da avaliação de riscos psicossociais que necessitam intervenção.
                </x-structure.message>

                <div class="w-full md:w-fit">
                    <x-action href="{{ route('control-actions.update') }}" width="full">
                        Editar medidas de controle
                    </x-action>
                </div>
                <div class="w-full md:w-fit">
                    @can('action-plan-edit')
                        <livewire:private.action-plan.generate-report-component>
                    @endcan
                </div>
            </div>
    
            <div class="w-full space-y-8">
                @foreach ($risks as $group => $groupRisks)
                    <div class="space-y-4">
                        <div class="bg-gray-100 px-4 py-2 w-full rounded-md shadow-md">
                            <h2 class="text-lg md:text-xl font-semibold">{{ App\Enums\PROART\PROARTGroup::from($group)->label() }}</h2>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            @foreach ($groupRisks as $riskName => $risk)
                                <div class="flex flex-col gap-4 bg-white w-full px-4 py-6 rounded-md shadow-md relative left-0 top-0 hover:left-0.5 hover:-top-0.5 transition-all">
                                    <div class="flex items-center justify-between bg-gradient-to-b from-[#FFFFFF25] gap-4 px-4 py-2 w-full rounded-md shadow-md
                                        {{ $risk['risk']['evaluated'] == App\Enums\PROART\PROARTRisk::CRITICAL ? 'to-[#fc6f6f50]' : '' }}
                                        {{ $risk['risk']['evaluated'] == App\Enums\PROART\PROARTRisk::HIGH ? 'to-[#dc933250]' : '' }}
                                        {{ $risk['risk']['evaluated'] == App\Enums\PROART\PROARTRisk::MEDIUM ? 'to-[#faed5d50]' : '' }}
                                        {{ $risk['risk']['evaluated'] == App\Enums\PROART\PROARTRisk::LOW ? 'to-[#76fc7150]' : '' }}
                                    ">
                                        <p class="truncate">{{ App\Enums\PROART\PROARTHazard::from($riskName)->label() }}</p>
                                        <p class="truncate">{{ $risk['risk']['evaluated']->label() }}</p>
                                    </div>
                                    <p class="px-3 font-semibold">Medidas de Controle e Prevenção</p>
                                    <ul class="grid grid-cols-1 px-4 gap-y-4 gap-x-4 list-disc pl-5">
                                        @foreach ($risk['control_actions'] as $type => $controlActions)
                                            <div class="space-y-2">
                                                <p class="text-sm text-main-text font-semibold">
                                                    {{ App\Enums\PROART\PROARTControlActionTypes::from($type)->label() }}
                                                </p>
                                            
                                                @foreach ($controlActions as $action)
                                                    <li class="text-sm w-full rounded-md">
                                                        {{ $action->content }}
                                                    </li>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </x-structure.main-content-container>
    </x-structure.page-container>

    
</x-layouts.app>