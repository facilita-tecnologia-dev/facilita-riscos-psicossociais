<div class="contents" x-data="{ videoModalOpen: false }" x-on:open-video-modal.window="videoModalOpen = true" x-on:close-video-modal.window="videoModalOpen = false">
    <x-new-components.structure.page-header icon="{{ $campaign->collection()->type == App\Enums\Campaign\CollectionType::PSYCHOSOCIAL ? 'brain' : 'cloud' }}" label="Responder Teste" :breadcrumbs="[
        $campaign->name => null,
        'Responder Teste' => null
    ]" />


    @if(session('auth:company')->test_helper_video)
        <div class="bg-secondary-background border-borders flex flex-col items-center gap-2 rounded-lg border px-6 py-4 shadow-sm sm:flex-row">
            <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
                <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">Vídeo de demonstração</h2>
                <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">Assista ao vídeo de demonstração para entender como responder ao teste da forma correta.</span>
            </div>

            <x-new-components.actions.button wire:click="openVideoModal" fitSize>
                <div wire:loading wire:target="openVideoModal">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="openVideoModal" class="font-heading text-main-background text-center text-sm font-semibold">Assistir vídeo</span>
            </x-new-components.actions.button>
        </div>


        {{-- Video Modal --}}
        <div x-show="videoModalOpen" x-transition.opacity x-cloak class="fixed inset-0 bg-black/60 flex items-center justify-center z-30 px-4">
            <div x-on:click.away="$wire.closeVideoModal()" class="bg-secondary-background border-borders flex flex-col gap-6 rounded-lg border p-6 shadow-sm w-full max-w-2xl">
                <header class="flex w-full items-center justify-between">
                    <h2 class="font-heading text-main-text text-left text-lg font-semibold">Video de demonstração</h2>

                    <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Assista ao vídeo de demonstração para entender como responder ao teste da forma correta.">
                        <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                    </div>
                </header>

                @if ($videoUrl)
                    <video src="{{ $videoUrl }}" controls autoplay class="w-full object-contain rounded-sm"></video>
                @else
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                @endif
            </div>
        </div>
    @endif

    <section id="campaign.answer" class="flex flex-col lg:grid lg:grid-cols-3 gap-4 items-start">
        <div class="flex flex-col gap-4 lg:col-span-2 ">
            <div class="w-full bg-secondary-background border-borders flex flex-col items-start gap-8 rounded-2xl border px-4 py-6 sm:px-6 sm:py-8 shadow-sm">
                <header class="flex w-full items-center justify-between">
                    <h2 class="font-heading text-main-text text-left text-lg font-semibold">Formulário de questões</h2>

                    <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Responda as questões através do formulário abaixo.">
                        <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                    </div>
                </header>

                <div id="container-question" class="w-full flex flex-col gap-6">
                    <header class="flex gap-2 justify-start items-start">
                        <div class="w-5 h-5 mt-0.5 shrink-0 bg-borders rounded-full flex items-center justify-center">
                            <span class="text-xs font-semibold text-main-text text-center font-heading">{{ $current + 1 }}</span>
                        </div>

                        <p class="text-sm sm:text-base text-main-text text-left font-heading font-normal">{{ $questions[$current]['statement'] }}</p>
                    </header>

                    <div class="flex flex-col gap-2">
                        @php
                            $collection = $campaign->collection();
                            $options = ($collection->type->value == 'psychosocial-risks' ?  ($collection->key == 'hse' 
                                    ? array_map(fn($option) => ['label' => $option->label(), 'value' => $questions[$current]['inverted'] ? $option->inverted() : $option->value] , App\Enums\Psychosocial\HSE\HSEOption::cases())
                                    : array_map(fn($option) => ['label' => $option->label(), 'value' => $questions[$current]['inverted'] ? $option->inverted() : $option->value] , App\Enums\Psychosocial\PROART\PROARTOption::cases())
                                )
                                : array_map(fn($option) => ['label' => $option->label(), 'value' => $questions[$current]['inverted'] ? $option->inverted() : $option->value] , App\Enums\OC\OCOption::cases()));
                        @endphp
                        @foreach ($options as $key => $option)        
                            <label wire:key="q_{{ $questions[$current]['id'] }}_{{ $option['value'] }}" class="px-4 py-3 bg-secondary-background border border-borders rounded-sm hover:brightness-95 transition cursor-pointer has-checked:bg-primary-solid/10 has-checked:border-primary-solid">
                                <input type="radio" wire:click="answer('{{ $option['value'] }}')" wire:loading.attr="disabled" wire:target="answer" class="hidden peer" name="question_{{ $questions[$current]['id'] }}" value="{{ $option['value'] }}" {{ (string)$answers[$questions[$current]['id']] === (string)$option['value'] ? 'checked' : '' }}>
                                <span class="text-sm text-left text-main-text peer-checked:text-primary-solid font-normal font-heading">{{ $option['label'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <nav class="w-full flex justify-between">
                    <x-new-components.actions.button wire:click="previous" :disabled="$current === 0" fitSize>
                        <span class="text-main-background font-heading text-center text-sm font-semibold">Anterior</span>
                    </x-new-components.actions.button>

                    <x-new-components.actions.button wire:click="next" :disabled="!($current < count($questions) - 1)" fitSize>
                        <span class="text-main-background font-heading text-center text-sm font-semibold">Próximo</span>
                    </x-new-components.actions.button>
                </nav>
            </div>

            @if($is_organizational)
                <div class="w-full bg-secondary-background border-borders flex flex-col items-start gap-8 rounded-2xl border px-4 py-6 sm:px-6 sm:py-8 shadow-sm">
                    <header class="flex w-full items-center justify-between">
                        <h2 class="font-heading text-main-text text-left text-lg font-semibold">Feedback</h2>

                        <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Deixe seu comentário, crítica, elogio ou sugestão.">
                            <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                        </div>
                    </header>

                    <div class="w-full">
                        <x-new-components.form.textarea wireModel="feedback" name="feedback" label="Seu feedback" placeholder="Deixe seu comentário, crítica, elogio ou sugestão..." tooltip="Deixe seu comentário, crítica, elogio ou sugestão" />
                    </div>
                </div>
            @endif
        </div>

        <aside class="w-full bg-secondary-background border-borders flex flex-col items-start gap-8 rounded-2xl border px-4 py-6 sm:px-6 sm:py-8 shadow-sm">
            <header class="flex w-full items-center justify-between">
                <h2 class="font-heading text-main-text text-left text-lg font-semibold">Informações</h2>

                <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Verifique abaixo as informações sobre o andamento do seu teste e clique em "Salvar Resposta" quando tiver respondido todas as questões.">
                    <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                </div>
            </header>

            <div id="progress" class="w-full flex flex-col gap-1.5">
                <header class="flex justify-between items-center">
                    <span class="text-primary-solid text-left text-sm font-semibold font-heading">Progresso</span>
                    <span class="text-primary-solid text-right text-sm font-semibold font-heading">{{ $this->progress }}%</span>
                </header>

                <div class="bg-borders h-1 w-full rounded-full">
                    <div class="bg-primary-solid h-full rounded-full" style="width: {{ $this->progress }}%"></div>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                @foreach($questions as $key => $question)
                    <button class="w-6 h-6 mt-0.5 shrink-0 {{ array_key_exists($question['id'], $answers) && $answers[$question['id']] !== null ? 'bg-primary-solid' : 'bg-borders' }} cursor-pointer rounded-full flex items-center justify-center" wire:click="goToQuestion({{ $key }})">
                        <span class="text-xs font-semibold {{ array_key_exists($question['id'], $answers) && $answers[$question['id']] !== null ? 'text-main-background' : 'text-main-text' }} text-center font-heading">{{ $key + 1 }}</span>
                    </button>
                @endforeach
            </div>

            <div id="caption" class="flex items-center gap-6">
                <div class="flex gap-2 items-center">
                    <div class="w-4 h-4 bg-borders rounded-full"></div>
                    <span class="text-sm text-main-text text-left font-normal font-heading">Não respondido</span>
                </div>
                <div class="flex gap-2 items-center">
                    <div class="w-4 h-4 bg-primary-solid rounded-full"></div>
                    <span class="text-sm text-main-text text-left font-normal font-heading">Respondido</span>
                </div>
            </div>

            <div class="w-full flex flex-col gap-3">
                <x-new-components.actions.button class="!bg-danger" wire:click="clearAnswers">
                    <div wire:loading wire:target="clearAnswers">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="clearAnswers" class="font-heading text-main-background text-center text-sm font-semibold">Limpar respostas</span>
                </x-new-components.actions.button>
                
                <x-new-components.actions.button wire:click="finish" :disabled="!$this->isCompleted">
                    <div wire:loading wire:target="finish">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="finish" class="font-heading text-main-background text-center text-sm font-semibold">Finalizar e Salvar</span>
                </x-new-components.actions.button>
             </div>
        </aside>
    </section>

</div>
