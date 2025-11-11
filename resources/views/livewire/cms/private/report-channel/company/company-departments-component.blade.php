<div class="w-full space-y-6">
    <h2 class="text-xl text-left text-main-text font-semibold">Configurar setores</h2>

    <div class="space-y-4">
        <header class="flex w-full flex-col-reverse justify-start gap-4 sm:flex-row sm:items-center sm:justify-end">
            @if (!empty($onlyTrashed))
                <label class="group ml-auto flex items-center gap-2 sm:m-0">
                    <input type="checkbox" wire:model.live="showTrashed" id="showTrashed" class="hidden" />
                    <div class="group-has-[:checked]:bg-primary-solid border-borders flex h-4.5 w-4.5 items-center justify-center rounded-sm border bg-transparent">
                        <x-icon icon="check" class="text-main-background hidden h-4 w-4 object-scale-down group-has-[:checked]:block" />
                    </div>
                    <span class="text-secondary-text font-text text-left text-sm leading-3.5 font-normal">Mostrar desativados</span>
                </label>
            @endif

            <form wire:submit.prevent="createDepartment" class="flex gap-2 sm:max-w-[500px] sm:flex-1">
                <x-new-components.form.input-text wireModel="new_department" name="new_department" placeholder="Digite o setor para adicionar..." isRequired />
    
                <x-new-components.actions.button class="!bg-report-channel-primary-solid" fitSize>
                    <div wire:loading wire:target="createDepartment">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>
    
                    <span wire:loading.remove wire:target="createDepartment" class="font-heading text-main-background text-center text-sm font-semibold">Adicionar</span>
                </x-new-components.actions.button>
            </form>
        </header>
    
        <div>
            @if (isset($departments) && count($departments) > 0)
                <x-new-components.table>
                    <x-new-components.table.thead class="grid-cols-1">
                        <x-new-components.table.th>
                            <span class="text-main-text font-text truncate text-sm font-semibold md:text-base">Nome do setor</span>
                        </x-new-components.table.th>
                    </x-new-components.table.thead>
                    <x-new-components.table.tbody>
                        @php
                            $departments = $showTrashed ? $onlyTrashed : $departments;
                        @endphp
                        @foreach ($departments as $department)
                            <x-new-components.table.tr wire:key="department-{{ $department['id'] }}" class="grid-cols-1" last="{{ $loop->last ? true : false }}" data-tippy-content="{{ $department['reports_count'] }} denúncias, {{ $department['users_count'] }} colaboradores">
                                <x-new-components.table.td>
                                    <span class="text-secondary-text font-text flex-1 truncate text-sm font-normal md:text-base" title="{{ $department['department'] }}">{{ $department['department'] }}</span>
                                    @if (!empty($department['deleted_at']))
                                        <x-new-components.circle-pulse color="bg-danger" size="size-2.5" tooltip="Desativado" />
                                    @else
                                        <x-new-components.circle-pulse color="bg-success" size="size-2.5" tooltip="Ativado" />
                                    @endif
    
                                    @if ($department['reports_count'] || $department['users_count'])
                                        @if (!empty($department['deleted_at']))
                                            <x-new-components.actions.button wire:click="restoreDepartment({{ $department['id'] }})" slim fitSize class="!bg-report-channel-primary-solid !h-8 !w-8 !p-0">
                                                <x-icon wire:loading.remove wire:target="restoreDepartment({{ $department['id'] }})" icon="refresh" class="text-main-background h-4 w-4 object-scale-down" />
                                                <x-icon wire:loading wire:target="restoreDepartment({{ $department['id'] }})" icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                                            </x-new-components.actions.button>
                                        @else
                                            <x-new-components.actions.button wire:click="softDeleteDepartment({{ $department['id'] }})" slim fitSize class="!bg-report-channel-primary-solid !h-8 !w-8 !p-0" data-tippy-content="Clique para desativar o setor (não aparecerá para novas denúncias)">
                                                <x-icon wire:loading.remove wire:target="softDeleteDepartment({{ $department['id'] }})" icon="x-mark" class="text-main-background h-4 w-4 object-scale-down" />
                                                <x-icon wire:loading wire:target="softDeleteDepartment({{ $department['id'] }})" icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                                            </x-new-components.actions.button>
                                        @endif
                                    @else
                                        <x-new-components.actions.button wire:click="deleteDepartment({{ $department['id'] }})" slim fitSize class="!bg-danger !h-8 !w-8 !p-0" data-tippy-content="Clique para excluir o setor do sistema">
                                            <x-icon wire:loading.remove wire:target="deleteDepartment({{ $department['id'] }})" icon="trash" class="text-main-background h-4 w-4 object-scale-down" />
                                            <x-icon wire:loading wire:target="deleteDepartment({{ $department['id'] }})" icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                                        </x-new-components.actions.button>
                                    @endif
                                </x-new-components.table.td>
                            </x-new-components.table.tr>
                        @endforeach
                    </x-new-components.table.tbody>
                </x-new-components.table>
            @else
                <div class="flex w-full items-center justify-center py-8 lg:h-full">
                    <p class="text-secondary-text font-text text-center text-sm font-normal md:text-base">Você não tem setores cadastrados.</p>
                </div>
            @endif
        </div>
    </div>
</div>

