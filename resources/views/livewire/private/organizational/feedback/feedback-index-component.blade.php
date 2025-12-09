<div class="contents">
    <x-new-components.structure.page-header icon="message" label="Lista de Feedbacks" :breadcrumbs="['Lista de Feedbacks' => null]" />

    @if (isset($feedbacks) && count($feedbacks) > 0)
        <div class="flex items-center justify-end">
            <x-new-components.actions.button wire:click='exportFeedbacks' fitSize>
                <div wire:loading wire:target="exportFeedbacks">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="exportFeedbacks" class="font-heading text-main-background text-center text-sm font-semibold">Exportar Lista de Feedbacks</span>
            </x-new-components.actions.button>
        </div>

        <div class="w-full flex-1">
            <x-new-components.table>
                <x-new-components.table.thead class="grid-cols-1 sm:grid-cols-[1fr_172px] lg:grid-cols-[1fr_172px_256px] gap-6">
                    <x-new-components.table.th>
                        <span class="block text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Conteúdo</span>
                    </x-new-components.table.th>
                    <x-new-components.table.th class="hidden sm:flex">
                        <span class="block text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Setor</span>
                    </x-new-components.table.th>
                    <x-new-components.table.th class="hidden lg:flex">
                        <span class="block text-main-text text-left font-text truncate text-sm font-semibold md:text-base">Data do Feedback</span>
                    </x-new-components.table.th>
                </x-new-components.table.thead>
                <x-new-components.table.tbody>
                    @foreach ($feedbacks as $feedback)
                        <x-new-components.table.tr class="grid-cols-1 sm:grid-cols-[1fr_172px] lg:grid-cols-[1fr_172px_256px] items-start gap-6" last="{{ $loop->last ? true : false }}">
                            <x-new-components.table.td>
                                <span class="text-secondary-text font-text text-sm font-normal md:text-base" title="{{ $feedback->content }}">{{ $feedback->content }}</span>
                            </x-new-components.table.td>
                            <x-new-components.table.td class="hidden sm:flex">
                                <span class="text-secondary-text font-text text-sm font-normal md:text-base" title="{{ $feedback->user->department }}">{{ $feedback->user->department }}</span>
                            </x-new-components.table.td>
                            <x-new-components.table.td class="hidden lg:flex">
                                <span class="text-secondary-text text-left font-text text-sm font-normal md:text-base" title="{{ $feedback->created_at->format('d/m/Y') }}">{{ $feedback->created_at->format('d/m/Y') }}</span>
                            </x-new-components.table.td>
                        </x-new-components.table.tr>
                    @endforeach
                </x-new-components.table.tbody>
            </x-new-components.table>
        </div>
    @else
        <div class="flex w-full items-center justify-center lg:h-full">
            <p class="text-secondary-text font-text text-center text-sm font-normal md:text-base">Nenhum feedback foi encontrado.</p>
        </div>
    @endif
</div>
