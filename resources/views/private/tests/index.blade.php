<x-layouts.app>
    <x-structure.page-container>
        <x-structure.sidebar />
        
        <x-structure.main-content-container class="items-center">
            <x-structure.page-title title="{{ $campaign->collection()->name }}" centered />

            <div class="w-full flex flex-col items-center gap-8">
                <div class="relative flex flex-col gap-3 w-full max-w-[600px] max-h-full pb-12">
                    <x-form action="{{ route('test', $campaign) }}" class="flex-1 flex flex-col gap-5" id="collection-form" post>
                        @foreach ($campaign->collection()->questions->shuffle() as $key => $question)
                            @php
                                $collection = $campaign->collection();

                                $options = $collection->type->value == 'psychosocial-risks'
                                                ?   (
                                                        $collection->key == 'hse' 
                                                        ? array_map(fn($option) => ['label' => $option->label(), 'value' => $option->value] , App\Enums\HSE\HSEOption::cases())
                                                        : array_map(fn($option) => ['label' => $option->label(), 'value' => $option->value] , App\Enums\PROART\PROARTOption::cases())
                                                    )
                                                : array_map(fn($option) => ['label' => $option->label(), 'value' => $option->value] , App\Enums\OC\OCOption::cases());
                            @endphp

                            <div data-role="test-question" class="w-full flex flex-col gap-2 items-center">
                                <div class="w-full px-4 py-2">
                                    <p class="text-base text-gray-800 text-left flex items-center gap-4 font-medium">
                                        <i class="fa-solid fa-question"></i>
                                        {{ $question['statement'] }}
                                    </p>
                                </div>

                                @foreach ($options as $option)
                                    <x-test.option  :option="$option"  name="{{  $question['id'] }}"  id="{{ 'question_' . $question['id'] . '_' . $option['value'] }}" />
                                @endforeach

                                @error("question_" . $question['id'])
                                    <span class="bg-rose-400  text-white text-base py-0.5 px-2 rounded-md">A questão {{ $question['id'] }} deve ser respondida</span>
                                @enderror
                            </div>
                        @endforeach
                    </x-form>
                    <div class="w-full sticky bottom-6">
                        <x-action form="collection-form" type="submit" tag="button" variant="secondary" width="full">
                            Salvar
                        </x-action>
                    </div>
                </div>
            </div>
        </x-structure.main-content-container>

        @if(session('errors'))
            <div class="bg-gray-100 border border-red-400 p-3 rounded-md fixed right-5 bottom-5 shadow-md">
                <p class="text-gray-800 font-regular text-xs md:text-sm">Todas as perguntas devem ser respondidas!</p>
            </div>
        @endif
    </x-structure.page-container>

    
    <script src="{{ asset('js/test.js') }}"></script>
</x-layouts.app>