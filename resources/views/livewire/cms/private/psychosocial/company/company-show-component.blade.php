<section class="flex flex-col gap-6 p-4">
    <div class="space-y-3">
        <div class="flex items-center gap-2">
            <x-icon icon="psychosocial" class="text-primary-solid h-6 w-6 object-scale-down" />
            <h1 class="text-main-text text-left text-xl font-semibold md:text-2xl">Facilita Riscos Psicossociais</h1>
        </div>

        <x-structure.breadcrumbs :links="[
            'Lista de empresas' => route('cms.psychosocial.company.index'),
            $company->name => null
        ]" />
    </div>

    <livewire:cms.private.psychosocial.company.company-edit-component :company="$company" />

    <div class="w-full space-y-4 lg:col-span-3">
        <div class="bg-secondary-background border-borders flex flex-col items-center gap-2 rounded-lg border px-6 py-4 shadow-sm sm:flex-row">
            <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
                <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">Lista de funcionários</h2>
                <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">Gerencie a lista de funcionários da empresa: crie, importe e edite colaboradores conforme necessário.</span>
            </div>

            <x-actions.button href="{{ route('cms.psychosocial.user.index', $company) }}" fitSize>
                <span class="text-main-background font-heading text-center text-sm font-semibold">Lista de funcionários</span>
            </x-actions.button>
        </div>
    </div>

    {{-- Editar Video --}}
    <div class="contents" x-data="{ editVideoModalOpen: false }" x-on:open-helper-video-modal.window="editVideoModalOpen = true" x-on:close-helper-video-modal.window="editVideoModalOpen = false">
        <div class="w-full space-y-4 lg:col-span-3">
            <div class="bg-secondary-background border-borders flex flex-col items-center gap-2 rounded-lg border px-6 py-4 shadow-sm sm:flex-row">
                <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
                    <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">Vídeo de Demonstração dos Testes</h2>
                    <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">Faça upload de um vídeo de demonstração que será exibido aos funcionários desta empresa antes de eles realizarem o teste.</span>
                </div>

                <x-actions.button wire:click="openHelperVideoModal" fitSize>
                    <span class="text-main-background font-heading text-center text-sm font-semibold">Editar vídeo</span>
                </x-actions.button>
            </div>
        </div>

        {{-- Editar Video Modal --}}
        <div x-show="editVideoModalOpen" x-transition.opacity x-cloak class="fixed inset-0 z-30 flex items-center justify-center bg-black/60 px-4">
            <div x-on:click.away="$wire.closeHelperVideoModal()" class="bg-secondary-background border-borders grid w-full max-w-5xl grid-cols-2 gap-6 rounded-lg border p-6 shadow-sm">
                <div class="flex flex-col gap-4">
                    <header class="flex w-full items-center justify-between">
                        <h2 class="font-heading text-main-text text-left text-lg font-semibold">Ver video de demonstração</h2>
                        <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Assista ao vídeo de demonstração para entender como responder ao teste da forma correta.">
                            <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                        </div>
                    </header>

                    <div class="flex w-full flex-1 items-center justify-center">
                        @if ($company->test_helper_video)
                            @if ($helper_video)
                                <video src="{{ $helper_video }}" controls autoplay muted class="w-full rounded-sm object-contain"></video>
                            @else
                                <x-icon icon="loading" class="text-secondary-text h-4 w-4 animate-spin object-scale-down" />
                            @endif
                        @else
                            <p class="text-secondary-text font-heading text-left text-sm font-normal sm:text-base">Nenhum video cadastrado.</p>
                        @endif
                    </div>

                    @if ($company->test_helper_video)
                        <x-actions.button wire:click="deleteHelperVideo" class="!bg-danger">
                            <div wire:loading wire:target="deleteHelperVideo">
                                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                            </div>
                            <span wire:loading.remove wire:target="deleteHelperVideo" class="font-heading text-main-background text-center text-sm font-semibold">Excluir vídeo</span>
                        </x-actions.button>
                    @endif
                </div>
                <div class="flex flex-col gap-4">
                    <header class="flex w-full items-center justify-between">
                        <h2 class="font-heading text-main-text text-left text-lg font-semibold">Editar video de demonstração</h2>
                        <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Assista ao vídeo de demonstração para entender como responder ao teste da forma correta.">
                            <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                        </div>
                    </header>

                    <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                        Use o campo de upload abaixo para enviar um novo vídeo de demonstração.
                        <span class="font-semibold">Atenção: se já existir um vídeo cadastrado, ele será substituído pelo novo arquivo.</span>
                    </p>

                    <form class="flex flex-col gap-2" wire:submit.prevent="updateHelperVideo">
                        <x-form.input-file wireModel="new_helper_video" name="new_helper_video" label="Vídeo de demonstração" placeholder="Faça upload do vídeo de demonstração..." tooltip="Faça upload do vídeo de demonstração" :attachments="$new_helper_video" isRequired />
                        <x-actions.button>
                            <div wire:loading wire:target="updateHelperVideo">
                                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                            </div>
                            <span wire:loading.remove wire:target="updateHelperVideo" class="font-heading text-main-background text-center text-sm font-semibold">Salvar</span>
                        </x-actions.button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="company-campaigns" class="space-y-4">
        <h2 class="text-xl text-left font-semibold text-main-text">Lista de Campanhas</h2>

        @if (isset($campaigns) && $campaigns->count())
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 items-start">
                @foreach ($campaigns as $campaign)
                    @php
                        $engagementLevel = App\Enums\Campaign\EngagementLevel::fromPercentage($campaign->engagement);
                    @endphp
                    <div class="p-6 rounded-2xl bg-secondary-background border border-borders shadow-sm flex flex-col gap-4">
                        <header class="flex justify-between items-start">
                            <div class="w-14 h-14 bg-primary-solid rounded-full flex items-center justify-center">
                                @if($campaign->collection()->type === App\Enums\Campaign\CollectionType::PSYCHOSOCIAL)
                                    <x-icon icon="brain" class="text-main-background h-6 w-6 object-scale-down" />
                                @else
                                    <x-icon icon="cloud" class="text-main-background h-6 w-6 object-scale-down" />
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                <div style="background-color: {{ $campaign->status->color() }}" class="w-2 h-2 rounded-full"></div>
                                <span class="text-main-text text-left text-xs font-normal">{{ $campaign->status->label() }}</span>
                            </div>
                        </header>

                        <div class="flex flex-col gap-3">
                            <div id="percentage" class="space-y-1.5">
                                <header class="flex items-center justify-between">
                                    <span style="color: {{ $engagementLevel->color() }}" class="font-heading text-left text-sm font-semibold">Adesão {{ $engagementLevel->value }} ({{ $campaign->userCollections->count() }} respondentes)</span>
                                    <span style="color: {{ $engagementLevel->color() }}" class="font-heading text-right text-sm font-semibold">{{ $campaign->engagement }}%</span>
                                </header>

                                <div class="bg-borders h-1 w-full rounded-full">
                                    <div style="background-color: {{ $engagementLevel->color() }}; width: {{ $campaign->engagement }}%" class="h-full rounded-full"></div>
                                </div>
                            </div>
                            <x-info-item label="Nome da Campanha" :value="$campaign->name" truncate />
                            <x-info-item label="Data" value="{{ $campaign->start_date->format('d/m/Y') . ' - ' . $campaign->end_date->format('d/m/Y') }}" truncate />
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex w-full">
                <p class="text-secondary-text font-heading text-center text-sm font-normal sm:text-base">A empresa não tem campanhas.</p>
            </div>
        @endif
    </div>
</section>
