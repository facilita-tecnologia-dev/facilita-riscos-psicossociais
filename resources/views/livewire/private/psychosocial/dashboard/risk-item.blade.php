<div x-data="{ dropdownOpen: false }" style="border-color: {{ $evaluation->color() }}" class="bg-main-background rounded-md border-1 p-3">
    @php
        $hazardName = session('auth:company')->usesHSE() ? App\Enums\Psychosocial\HSE\HSEHazard::from($hazardName)->label() : App\Enums\Psychosocial\PROART\PROARTHazard::from($hazardName)->label();
    @endphp

    <button class="flex w-full items-center justify-between cursor-pointer" @click="dropdownOpen = !dropdownOpen" data-tippy-content="Clique para alternar a visão das medidas de controle desse perigo psicossocial.">
        <span class="text-main-text text-left text-sm sm:text-base font-normal">{{ $hazardName }}</span>

        <div style="border-color: {{ $evaluation->color() }}" class="h-4 w-4 rounded-full border-3 bg-transparent"></div>
    </button>

    <div x-show="dropdownOpen" x-collapse class="mt-4 text-main-text flex flex-col gap-4">
        <header class="flex items-center justify-between">
            <h4 class="text-main-text text-left font-semibold text-sm sm:text-base">Medidas de Controle e Prevenção</h3>

            <div class="cursor-pointer transition" data-tippy-content="Abaixo estão listadas as medidas de controle que você definiu ou, caso não tenha feito alterações, as medidas padrão do sistema. Se desejar modificá-las, acesse a página “Medidas de Controle” pelo botão “Editar Medidas de Controle” no card de ações.">
                <x-icon icon="circle-question-mark" class="text-secondary-text h-4 w-4 sm:h-5 sm:w-5 object-contain" />
            </div>
        </header>

        <ul class="space-y-3">
            @if(session('auth:company')->usesHSE())
                @foreach ($controlActions as $type => $action)            
                    <li class="flex items-start gap-2">
                        <div class="h-2 w-2 shrink-0 mt-1.5" style="background: {{ $evaluation->color() }}"></div>
                        <span class="flex-1 text-sm text-main-text text-left font-normal">{{ $action['content'] }}</span>
                    </li>
                @endforeach
            @else
                @foreach ($controlActions as $type => $actions)       
                    <span class="block text-sm font-semibold text-main-text text-left">{{ App\Enums\Psychosocial\PROART\PROARTControlActionTypes::from($type)->label() }}</span>     
                    @foreach ($actions as $action)            
                        <li class="flex items-start gap-2">
                            <div class="h-2 w-2 shrink-0 mt-1.5" style="background: {{ $evaluation->color() }}"></div>
                            <span class="flex-1 text-sm text-main-text text-left font-normal">{{ $action['content'] }}</span>
                        </li>
                    @endforeach
                @endforeach
            @endif
        </ul>
    </div>
</div>
