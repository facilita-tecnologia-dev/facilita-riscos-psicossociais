<div class="contents" x-data="{ videoModalOpen: false }" x-on:open-video-modal.window="videoModalOpen = true" x-on:close-video-modal.window="videoModalOpen = false">
    <x-structure.page-header icon="{{ $campaign->collection()->type == App\Enums\Campaign\CollectionType::PSYCHOSOCIAL ? 'brain' : 'cloud' }}" label="{{ __('test.page_title') }}" :breadcrumbs="[
        $campaign->name => null,
        __('test.breadcrumb_current') => null
    ]" />

    {{-- <div class="bg-secondary-background border-borders flex flex-col items-center gap-2 rounded-lg border px-6 py-4 shadow-sm sm:flex-row">
        <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
            <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">Tradução</h2>
            <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">Deseja traduzir esta página para outros idiomas? Defina o idioma desejado através dos botões ao lado.</span>
        </div>

        <div class="flex gap-2">
            <button wire:click="changeLocale('pt_BR')" class="p-2 bg-secondary-background border border-borders rounded-md hover:brightness-95 transition cursor-pointer">
                🇧🇷 Português
            </button>

            <button wire:click="changeLocale('en')" class="p-2 bg-secondary-background border border-borders rounded-md hover:brightness-95 transition cursor-pointer">
                🇪🇸 English
            </button>

            <button wire:click="changeLocale('es')" class="p-2 bg-secondary-background border border-borders rounded-md hover:brightness-95 transition cursor-pointer">
                🇪🇸 Español
            </button>

            <button wire:click="changeLocale('fr')" class="p-2 bg-secondary-background border border-borders rounded-md hover:brightness-95 transition cursor-pointer">
                🇫🇷 Français
            </button>
        </div>
    </div> --}}

    <div class="ml-auto w-fit flex border border-borders rounded-md">
        <button wire:click="changeLocale('pt_BR')" class="flex items-center gap-2 {{ $locale === 'pt_BR' ? 'bg-primary-solid/30' : 'bg-main-background' }} rounded-l-md cursor-pointer px-3 py-2 text-sm font-normal transition hover:brightness-95" class="text-secondary-text">
            <img src="https://flagcdn.com/w20/br.png" width="20" alt="Brazil" class="rounded-xs">
            <span class="hidden sm:inline">Português</span>
            <span class="sm:hidden inline">BR</span>
        </button>

        <button wire:click="changeLocale('en')" class="flex items-center gap-2 {{ $locale === 'en' ? 'bg-primary-solid/30' : 'bg-main-background' }} rounded-r-md cursor-pointer px-3 py-2 text-sm font-normal transition hover:brightness-95" class="text-secondary-text">
            <img src="https://flagcdn.com/w20/us.png" width="20" alt="USA" class="rounded-xs">
            <span class="hidden sm:inline">English</span>
            <span class="sm:hidden inline">EN</span>
        </button>

        <button wire:click="changeLocale('es')" class="flex items-center gap-2 {{ $locale === 'es' ? 'bg-primary-solid/30' : 'bg-main-background' }} rounded-r-md cursor-pointer px-3 py-2 text-sm font-normal transition hover:brightness-95" class="text-secondary-text">
            <img src="https://flagcdn.com/w20/es.png" width="20" alt="Spain" class="rounded-xs">
            <span class="hidden sm:inline">Español</span>
            <span class="sm:hidden inline">ES</span>
        </button>

        <button wire:click="changeLocale('fr')" class="flex items-center gap-2 {{ $locale === 'fr' ? 'bg-primary-solid/30' : 'bg-main-background' }} rounded-r-md cursor-pointer px-3 py-2 text-sm font-normal transition hover:brightness-95" class="text-secondary-text">
            <img src="https://flagcdn.com/w20/fr.png" width="20" alt="France" class="rounded-xs">
            <span class="hidden sm:inline">Français</span>
            <span class="sm:hidden inline">FR</span>
        </button>
    </div>

    @if(session('auth:company')->test_helper_video)
        <div class="bg-secondary-background border-borders flex flex-col items-center gap-2 rounded-lg border px-6 py-4 shadow-sm sm:flex-row">
            <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
                <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">{{ __('test.video_title') }}</h2>
                <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">{{ __('test.video_description') }}</span>
            </div>

            <x-actions.button wire:click="openVideoModal" fitSize>
                <div wire:loading wire:target="openVideoModal">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="openVideoModal" class="font-heading text-main-background text-center text-sm font-semibold">{{ __('test.watch_video') }}</span>
            </x-actions.button>
        </div>

        {{-- Video Modal --}}
        <div x-show="videoModalOpen" x-transition.opacity x-cloak class="fixed inset-0 bg-black/60 flex items-center justify-center z-30 px-4">
            <div x-on:click.away="$wire.closeVideoModal()" class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-6 shadow-sm w-[80vw] h-[80vh]">
                <header class="flex w-full items-center">
                    <h2 class="font-heading text-main-text text-left text-lg font-semibold">{{ __('test.video_title') }}</h2>
                </header>

                @if ($videoUrl)
                    <div class="flex-1 min-h-0 flex items-center justify-center">
                        <video 
                            src="{{ $videoUrl }}" 
                            controls 
                            autoplay
                            wire:ignore
                            x-on:ended="$wire.markVideoAsFinished()"
                            class="max-h-full max-w-full object-contain rounded-md">
                        </video>
                    </div>
                @else
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                @endif

                @if($video_finished)
                    <x-actions.button class="w-full" wire:click='confirmVideoWatched'>
                        <div wire:loading wire:target="confirmVideoWatched">
                            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                        </div>

                        <span wire:loading.remove wire:target="confirmVideoWatched" class="font-heading text-main-background text-center text-sm font-semibold">
                            {{ __('test.continue') }}
                        </span>
                    </x-actions.button>
                @else
                    <x-actions.button class="w-full opacity-50 cursor-not-allowed" disabled>
                        <span class="font-heading text-main-background text-center text-sm font-semibold">
                            {{ __('test.watch_until_end') }}
                        </span>
                    </x-actions.button>
                @endif
            </div>
        </div>
    @endif

    @if($video_watched)
        <section id="campaign.answer" class="flex flex-col lg:grid lg:grid-cols-3 gap-4 items-start pb-16 sm:pb-0">
            <div class="flex flex-col gap-4 w-full lg:col-span-2">
                <div class="w-full bg-secondary-background border-borders flex flex-col items-start gap-8 rounded-2xl border px-4 py-6 sm:px-6 sm:py-8 shadow-sm">
                    <header class="flex w-full items-center justify-between">
                        <h2 class="font-heading text-main-text text-left text-lg font-semibold">{{ __('test.form_title') }}</h2>

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
                        <x-actions.button wire:click="previous" :disabled="$current === 0" fitSize>
                            <span class="text-main-background font-heading text-center text-sm font-semibold">{{ __('test.previous') }}</span>
                        </x-actions.button>

                        <x-actions.button wire:click="next" :disabled="!($current < count($questions) - 1)" fitSize>
                            <span class="text-main-background font-heading text-center text-sm font-semibold">{{ __('test.next') }}</span>
                        </x-actions.button>
                    </nav>
                </div>

                @if($is_organizational)
                    <div class="w-full bg-secondary-background border-borders flex flex-col items-start gap-8 rounded-2xl border px-4 py-6 sm:px-6 sm:py-8 shadow-sm">
                        <header class="flex w-full items-center justify-between">
                            <h2 class="font-heading text-main-text text-left text-lg font-semibold">Feedback</h2>
                        </header>

                        <div class="w-full">
                            <x-form.textarea wireModel="feedback" name="feedback" label="Seu feedback" placeholder="{{ __('test.feedback_placeholder') }}" tooltip="{{ __('test.feedback_placeholder') }}" />
                        </div>
                    </div>
                @endif
            </div>

            <aside class="w-full bg-secondary-background border-borders flex flex-col items-start gap-8 rounded-2xl border px-4 py-6 sm:px-6 sm:py-8 shadow-sm">
                <header class="flex w-full items-center justify-between">
                    <h2 class="font-heading text-main-text text-left text-lg font-semibold">{{ __('test.information_title') }}</h2>

                    <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Verifique abaixo as informações sobre o andamento do seu teste e clique em "Salvar Resposta" quando tiver respondido todas as questões.">
                        <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                    </div>
                </header>

                <div id="progress" class="w-full flex flex-col gap-1.5">
                    <header class="flex justify-between items-center">
                        <span class="text-primary-solid text-left text-sm font-semibold font-heading">{{ __('test.progress_title') }}</span>
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
                        <span class="text-sm text-main-text text-left font-normal font-heading">{{ __('test.question_not_answered') }}</span>
                    </div>
                    <div class="flex gap-2 items-center">
                        <div class="w-4 h-4 bg-primary-solid rounded-full"></div>
                        <span class="text-sm text-main-text text-left font-normal font-heading">{{ __('test.question_answered') }}</span>
                    </div>
                </div>

                <div class="w-full flex flex-col gap-3">
                    <x-actions.button class="!bg-danger" wire:click="clearAnswers">
                        <div wire:loading wire:target="clearAnswers">
                            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                        </div>

                        <span wire:loading.remove wire:target="clearAnswers" class="font-heading text-main-background text-center text-sm font-semibold">{{ __('test.clear_answers') }}</span>
                    </x-actions.button>
                    
                    <x-actions.button wire:click="finish" :disabled="!$this->isCompleted">
                        <div wire:loading wire:target="finish">
                            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                        </div>

                        <span wire:loading.remove wire:target="finish" class="font-heading text-main-background text-center text-sm font-semibold">{{ __('test.finish_and_save') }}</span>
                    </x-actions.button>
                </div>
            </aside>
        </section>
    @endif

</div>
