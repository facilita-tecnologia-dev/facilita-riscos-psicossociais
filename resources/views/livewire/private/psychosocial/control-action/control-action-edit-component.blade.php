<div class="contents">
    <x-structure.page-header icon="brain" label="Medidas de Controle" :breadcrumbs="['Medidas de Controle' => null]" />
    
    @if(isset($controlActions) && count($controlActions) > 0)
        <div class="border-borders bg-main-background flex flex-col gap-3 rounded-lg border p-4">
            <form class="flex flex-col md:flex-row md:items-end gap-3 md:gap-4" wire:submit.prevent="filter">
                <x-form.select wireModel="hazard" name="hazard" label="Dimensão" placeholder="Selecione a dimensão" tooltip="Selecione a dimensão" :options="$hazards" />
                <x-form.select wireModel="risk_level" name="risk_level" label="Nível de Risco" placeholder="Selecione o nível de risco" :options="$risk_levels" />
    
                <div class="w-full md:w-fit"> 
                    <x-actions.button type="submit">
                        <div wire:loading wire:target="filter">
                            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                        </div>
    
                        <span wire:loading.remove wire:target="filter" class="font-heading text-main-background text-center text-sm font-semibold">Filtrar</span>
                    </x-actions.button>
                </div>
            </form>
        </div>

        <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-4 items-start">
            @foreach ($controlActions as $hazard => $risks)        
                @if(session('auth:company')->usesHSE())
                    <div class="border-borders bg-main-background flex flex-col gap-4 rounded-lg border p-4 md:col-span-2 xl:col-span-1">
                        <header class="flex items-center justify-between">
                            <h2 class="text-main-text font-heading text-left text-lg font-semibold">{{ App\Enums\Psychosocial\HSE\HSEHazard::from($hazard)->label() }}</h2>
    
                            <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Neste card, você pode editar as medidas de controle do perigo psicossocial '{{ App\Enums\Psychosocial\HSE\HSEHazard::from($hazard)->label() }}'">
                                <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                            </div>
                        </header>
    
                        <div class="flex flex-col gap-4">
                            @foreach ($risks as $risk => $types)
                                <div class="space-y-2">
                                    <div style="border-color: {{ App\Enums\Psychosocial\HSE\HSERisk::from($risk)->color() }}" class="w-full rounded-md border px-4 py-2 flex justify-between items-center gap-2">
                                        <h2 class="text-sm sm:text-base text-left text-main-text font-semibold flex-1">
                                            {{ App\Enums\Psychosocial\HSE\HSERisk::from($risk)->label() }}
                                        </h2>
    
                                        <div style="border-color: {{ App\Enums\Psychosocial\HSE\HSERisk::from($risk)->color() }}" class="h-4 w-4 rounded-full border-3 bg-transparent"></div>
                                    </div>
    
                                    <div class="space-y-2">
                                        @forelse ($types as $action)
                                            <livewire:private.psychosocial.control-action.control-action-item-component wire:key="{{ uniqid() }}" :action="$action">

                                            @if(!$loop->last)
                                                <div class="h-[1px] w-full bg-borders"></div>
                                            @endif
                                        @empty
                                            <div class="flex justify-center">
                                                <span class="text-secondary-text text-center text-sm">Nenhuma medida de controle</span>
                                            </div>
                                        @endforelse
                                    </div>
    
                                    <button wire:click='create("{{ $hazard }}", null, "{{ $risk }}")' class="w-full bg-borders flex justify-center items-center py-2 px-4 rounded-sm cursor-pointer hover:brightness-95 transition">
                                        <span wire:loading.remove wire:target='create("{{ $hazard }}", null, "{{ $risk }}")' class="text-xs text-center text-main-text font-normal">Adicionar medida</span>
                                        
                                        <div wire:loading wire:target='create("{{ $hazard }}", null, "{{ $risk }}")'>
                                            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                                        </div>
                                    </button>
                                </div>  
    
                                @if(!$loop->last)
                                    <div class="h-[1px] w-full bg-borders"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="border-borders bg-main-background flex flex-col gap-4 rounded-lg border p-4 md:col-span-2 xl:col-span-1">
                        <header class="flex items-center justify-between">
                            <h2 class="text-main-text font-heading text-left text-lg font-semibold">{{ App\Enums\Psychosocial\PROART\PROARTHazard::from($hazard)->label() }}</h2>
    
                            <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Neste card, você pode editar as medidas de controle do perigo psicossocial '{{ App\Enums\Psychosocial\PROART\PROARTHazard::from($hazard)->label() }}'">
                                <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                            </div>
                        </header>

                        <div class="flex flex-col gap-4">
                            @foreach ($risks as $risk => $types)
                                <div class="space-y-2">
                                    <div style="border-color: {{ App\Enums\Psychosocial\PROART\PROARTRisk::from($risk)->color() }}" class="w-full rounded-md border px-4 py-2 flex justify-between items-center gap-2">
                                        <h2 class="text-sm sm:text-base text-left text-main-text font-semibold flex-1">
                                            {{ App\Enums\Psychosocial\PROART\PROARTRisk::from($risk)->label() }}
                                        </h2>
    
                                        <div style="border-color: {{ App\Enums\Psychosocial\PROART\PROARTRisk::from($risk)->color() }}" class="h-4 w-4 rounded-full border-3 bg-transparent"></div>
                                    </div>

                                     @foreach(App\Enums\Psychosocial\PROART\PROARTControlActionTypes::cases() as $actionType)
                                        <div class="w-full flex items-center gap-2">
                                            <h2 class="text-sm text-left font-semibold">{{ $actionType->label() }}</h2>
                                        </div>
     
                                        @if(isset($types[$actionType->value]))
                                            @forelse ($types[$actionType->value] as $action)
                                                <livewire:private.psychosocial.control-action.control-action-item-component wire:key="control-action-{{ uniqid() }}"  :action="$action">
                                                @if(!$loop->last)
                                                    <div class="block md:hidden h-[1px] w-full bg-borders"></div>
                                                @endif
                                            @empty
                                                <div class="flex justify-center">
                                                    <span class="text-secondary-text text-center text-sm">Nenhuma medida de controle</span>
                                                </div>
                                            @endforelse
                                        @endif

                                        <button wire:click='create("{{ $hazard }}", "{{ $actionType->value }}", "{{ $risk }}")' class="w-full bg-borders flex justify-center items-center py-2 px-4 rounded-sm cursor-pointer hover:brightness-95 transition">
                                            <span wire:loading.remove wire:target='create("{{ $hazard }}", "{{ $actionType->value }}", "{{ $risk }}")' class="text-xs text-center text-main-text font-normal">Adicionar medida</span>
                                            
                                            <div wire:loading wire:target='create("{{ $hazard }}", "{{ $actionType->value }}", "{{ $risk }}")'>
                                                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                                            </div>
                                        </button>
                                    @endforeach
                                </div>  
    
                                @if(!$loop->last)
                                    <div class="h-[1px] w-full bg-borders"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="flex w-full items-center justify-center lg:h-full">
            <p class="text-secondary-text font-text text-center text-sm font-normal md:text-base">Nenhuma medida de controle foi encontrada.</p>
        </div>
    @endif
</div>

