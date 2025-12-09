<div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-4">
    @foreach ($this->controlActions as $hazard => $risks)        
        @if(session('auth:company')->usesHSE())
            <div class="space-y-4 p-4 md:p-5 lg:p-6 bg-main-background rounded-md shadow-md">
                <div class="w-full rounded-md shadow-md p-4 flex items-center gap-2 bg-gray-500">
                    <h2 class="text-base sm:text-lg text-main-background text-center font-semibold flex-1">{{ App\Enums\Psychosocial\HSE\HSEHazard::from($hazard)->label() }}</h2>
                </div>
                <div class="space-y-4">
                    @foreach ($risks as $risk => $types)
                        <div class="space-y-5">
                            <div style="background-color: {{ App\Enums\Psychosocial\HSE\HSERisk::from($risk)->color() }}" class="w-full rounded-md shadow-md px-4 py-2 flex items-center gap-2">
                                <h2 class="text-sm sm:text-base text-center font-semibold flex-1">
                                    {{ App\Enums\Psychosocial\HSE\HSERisk::from($risk)->label() }}
                                </h2>
                            </div>

                            <div class="space-y-3">
                                @forelse ($types as $action)
                                    <livewire:private.action-plan.control-action-form-component wire:key="{{ 'ca-' . $action->id }}" :action="$action">
                                @empty
                                    <div class="flex justify-center">
                                        <span class="text-secondary-text text-center text-sm">Nenhuma medida de controle</span>
                                    </div>
                                @endforelse
                                
                                <button wire:click='create("{{ $hazard }}", null, "{{ $risk }}")' class="w-full bg-borders flex justify-center items-center py-2 px-4 rounded-sm cursor-pointer hover:brightness-95 transition">
                                    <span wire:loading.remove wire:target='create("{{ $hazard }}", null, "{{ $risk }}")' class="text-xs text-center text-main-text font-normal">Adicionar medida</span>
                                    
                                    <div wire:loading wire:target='create("{{ $hazard }}", null, "{{ $risk }}")'>
                                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                                    </div>
                                </button>
                            </div>
                        </div>  
                    @endforeach
                </div>
            </div>
        @else
            <div class="space-y-4 p-4 md:p-5 lg:p-6 bg-main-background rounded-md shadow-md">
                <div class="w-full rounded-md shadow-md p-4 flex items-center gap-2 bg-gray-500">
                    <h2 class="text-base sm:text-lg text-main-background text-center font-semibold flex-1">{{ App\Enums\Psychosocial\PROART\PROARTHazard::from($hazard)->label() }}</h2>
                </div>
                <div class="space-y-4">
                @foreach ($risks as $risk => $types)
                    <div class="space-y-5">
                        
                        <div class="w-full rounded-md shadow-md px-4 py-2 flex items-center gap-2
                            {{ $risk == App\Enums\Psychosocial\PROART\PROARTRisk::CRITICAL->value ? 'bg-[#F26C6C75]' : '' }}
                            {{ $risk == App\Enums\Psychosocial\PROART\PROARTRisk::HIGH->value ? 'bg-[#F6B26B75]' : '' }}
                            {{ $risk == App\Enums\Psychosocial\PROART\PROARTRisk::MEDIUM->value ? 'bg-[#DDE26F75]' : '' }}
                            {{ $risk == App\Enums\Psychosocial\PROART\PROARTRisk::LOW->value ? 'bg-[#A8E6CFCC]' : '' }}
                        ">
                            <h2 class="text-sm sm:text-base text-center font-semibold flex-1">
                                {{ App\Enums\Psychosocial\PROART\PROARTRisk::from($risk)->label() }}
                            </h2>
                        </div>

                        <div class="space-y-3">
                            @foreach(App\Enums\Psychosocial\PROART\PROARTControlActionTypes::cases() as $actionType)
                                <div class="w-full px-4 py-2 flex items-center gap-2">
                                    <h2 class="text-base text-center font-normal flex-1">{{ $actionType->label() }}</h2>
                                </div>

                                @if(isset($types[$actionType->value]))
                                    @foreach ($types[$actionType->value] as $action)
                                        <livewire:private.action-plan.control-action-form-component wire:key="{{ 'ca-' . $action->id }}" :action="$action">
                                    @endforeach
                                @else
                                    <div class="flex justify-center">
                                        <span class="text-secondary-text text-center text-sm">Nenhuma medida de controle</span>
                                    </div>
                                @endif

                                <button wire:click='create("{{ $hazard }}", "{{ $actionType->value }}", "{{ $risk }}")' class="w-full bg-borders flex justify-center items-center py-2 px-4 rounded-sm cursor-pointer hover:brightness-95 transition">
                                    <span wire:loading.remove wire:target='create("{{ $hazard }}", "{{ $actionType->value }}", "{{ $risk }}")' class="text-xs text-center text-main-text font-normal">Adicionar medida</span>
                                    
                                    <div wire:loading wire:target='create("{{ $hazard }}", "{{ $actionType->value }}", "{{ $risk }}")'>
                                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>  
                @endforeach
                </div>
            </div>
        @endif
    @endforeach
</div>
