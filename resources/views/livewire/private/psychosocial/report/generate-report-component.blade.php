<div x-data="{ reportModalOpen: false }" x-on:open-report-modal.window="reportModalOpen = true" x-on:close-report-modal.window="reportModalOpen = false" class="contents">
    <x-actions.button  wire:click="openReportModal" class="w-full">
        <span class="font-heading text-main-background text-center text-sm font-semibold">Exportar Inventário de Riscos</span>
    </x-actions.button>


    @if($processing && !$ready)
        <div class="flex flex-col gap-2 items-start fixed w-full max-w-96 right-4 bottom-4 bg-main-background rounded-md border border-borders shadow-md px-6 py-4" wire:poll.500ms="poll">
            <span class="text-sm font-semibold text-secondary-text text-left">Gerando Inventário de Riscos</span>
            <div class="w-full bg-borders rounded-sm h-3">
                <div class="bg-primary-solid h-full rounded transition-all duration-500" style="width: {{ $progress }}%;"></div>
            </div>
        </div>
    @endif

    <div x-show="reportModalOpen" x-transition.opacity x-cloak class="fixed inset-0 z-30 flex items-center justify-center bg-black/60 px-4">
        <div x-on:click.away="$wire.closeReportModal()" class="bg-secondary-background border-borders grid w-full max-w-5xl grid-cols-1 md:grid-cols-2 gap-6 rounded-lg border p-6 shadow-sm">
            <div class="flex flex-col gap-4">
                <header class="flex w-full items-center justify-between">
                    <h2 class="font-heading text-main-text text-left text-base sm:text-lg font-semibold">Exportar Inventário de Riscos Psicossociais</h2>
                    <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Nesta seção, você pode exportar um Inventário de Riscos Psicossociais já gerado. Caso deseje criar um novo inventário com as medidas de controle atualizadas, utilize a seção à direita.">
                        <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                    </div>
                </header>

                @if($report->file_path && Storage::disk('s3')->exists($report->file_path))
                    <div class="space-y-2">            
                        @php
                            $s3 = Storage::disk('s3');
                            $filename = basename($report->file_path);
                            $size = $s3->size($report->file_path);
                            $extension = pathinfo($report->file_path, PATHINFO_EXTENSION);
                        @endphp

                        <div class="bg-borders flex w-full items-center gap-2 rounded-sm p-3">
                            <x-file-icon type="{{ $extension }}" />
                            <span class="font-text text-secondary-text flex-1 truncate text-sm font-normal md:text-base" title="{{ $filename }}">{{ $filename }}</span>
                            <span class="font-text text-secondary-text truncate text-xs font-normal">{{ round($size / 1024 / 1024, 2) }}MB</span>
                        </div>

                        <div class="flex items-center">
                            <span class="text-sm text-secondary-text text-left font-normal">Gerado em: {{ $report->file_date->format('d/m/Y - H:i:s') }}.</span>
                        </div>
                    </div>

                    <x-actions.button wire:click="downloadReport">
                        <div wire:loading wire:target="downloadReport">
                            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                        </div>
                        <span wire:loading.remove wire:target="downloadReport" class="font-heading text-main-background text-center text-sm font-semibold">Fazer download</span>
                    </x-actions.button>
                @else
                    <div class="flex w-full flex-1 items-center justify-center">
                        <p class="text-secondary-text font-heading text-center text-sm font-normal sm:text-base">Você ainda não gerou nenhum Inventário de Riscos Psicossociais.</p>
                    </div>
                @endif
            </div>
            
            <div class="flex flex-col gap-4">
                <header class="flex w-full items-center justify-between">
                    <h2 class="font-heading text-main-text text-left text-base sm:text-lg font-semibold">Gerar Inventário de Riscos Psicossociais</h2>
                    <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Nesta seção, você pode gerar um novo Inventário de Riscos Psicossociais conforme suas preferências. Basta selecionar o tipo e o formato desejados e clicar em “Gerar novo”. Após a geração, você receberá uma notificação na tela e poderá retornar a este modal para fazer o download do inventário.">
                        <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                    </div>
                </header>

                <form class="w-full space-y-4" wire:submit.prevent="submit">
                    <div class="flex w-full flex-col items-center gap-3">
                        <header class="flex w-full items-center justify-between">
                            <h3 class="text-main-text text-center text-sm font-semibold">Tipo</h3>
                            <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Nas opções abaixo, selecione o tipo de Inventário de Riscos que deseja exportar.">
                                <x-icon icon="circle-question-mark" class="text-secondary-text h-4 w-4 object-contain" />
                            </div>
                        </header>
                        <div class="grid w-full grid-cols-2 gap-2">
                            @foreach (App\Enums\Psychosocial\RiskInventoryType::cases() as $type)
                                <label class="border-borders has-checked:bg-primary-solid hover:bg-secondary-background flex cursor-pointer items-center justify-center rounded-md border py-2 transition">
                                    <input type="radio" wire:model="type" id="department" value="{{ $type->value }}" class="peer hidden" />
                                    <span class="text-main-text peer-checked:text-main-background text-center text-sm font-normal transition">{{ $type->label() }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex w-full flex-col items-center gap-3">
                        <header class="flex w-full items-center justify-between">
                            <h3 class="text-main-text text-center text-sm font-semibold">Formato</h3>
                            <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Nas opções abaixo, selecione o formato do Inventário de Riscos que deseja exportar.">
                                <x-icon icon="circle-question-mark" class="text-secondary-text h-4 w-4 object-contain" />
                            </div>
                        </header>
                        <div class="grid w-full grid-cols-2 gap-2">
                            @foreach (App\Enums\Psychosocial\RiskInventoryFormat::cases() as $format)
                                <label class="border-borders has-checked:bg-primary-solid hover:bg-secondary-background flex cursor-pointer items-center justify-center rounded-md border py-2 transition">
                                    <input type="radio" wire:model="format" id="pdf" value="{{ $format->value }}" class="peer hidden" />
                                    <span class="text-main-text peer-checked:text-main-background text-center text-sm font-normal transition">{{ $format->label() }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <x-actions.button type="submit">
                        <div wire:loading wire:target="submit">
                            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                        </div>
                        <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Exportar</span>
                    </x-actions.button>
                </form>
            </div>
        </div>
    </div>
</div>
