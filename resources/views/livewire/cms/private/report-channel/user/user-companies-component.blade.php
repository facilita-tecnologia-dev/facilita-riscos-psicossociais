<div class="w-full space-y-6">
    <h2 class="text-xl text-left text-main-text font-semibold">Empresas</h2>
    
    <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="attach">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-end">
            <div class="{{ $user['type'] === App\Enums\ReportChannel\ReportChannelUserTypes::EMPLOYEE->value && $selectedCompanyDepartments ? '' : 'col-span-2' }}">
                <x-new-components.form.select wireModel="company" name="company" label="Vincular à empresa" placeholder="Selecione a empresa" tooltip="Selecione a empresa à qual você deseja vincular este usuário. Caso não queira vinculá-lo a nenhuma empresa por enquanto, selecione a opção 'Nenhuma'." :options="$companiesToAttach" isRequired  wireModelType="live" />
            </div>
            
            @if($user['type'] === App\Enums\ReportChannel\ReportChannelUserTypes::EMPLOYEE->value && $selectedCompanyDepartments)
                <x-new-components.form.select wireModel="department" name="department" label="Setor" placeholder="Selecione o setor" tooltip="Selecione um setor da empresa para vincular este usuário. Caso não queira vinculá-lo a nenhum setor, altere o tipo de usuário para Consultor ou Jurídico." :options="$selectedCompanyDepartments" isRequired />
            @endif

            <x-new-components.actions.button class="!bg-report-channel-primary-solid" disabled="{{ $company && $user['type'] === App\Enums\ReportChannel\ReportChannelUserTypes::EMPLOYEE->value && !$selectedCompanyDepartments }}">
                <div wire:loading wire:target="attach">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="attach" class="font-heading text-main-background text-center text-sm font-semibold">Vincular</span>
            </x-new-components.actions.button>
        </div>
        @if($company && $user['type'] === App\Enums\ReportChannel\ReportChannelUserTypes::EMPLOYEE->value && !$selectedCompanyDepartments)
            <div class="text-sm text-secondary-text font-regular text-left">
                <p>A empresa selecionada não possui setores cadastrados. Enquanto não houver setores, não será possível vincular usuários do tipo Colaborador da empresa. Cadastre setores ou vincule usuários dos tipos Consultor ou Jurídico.</p>
            </div>
        @endif
    </form>

    <div>
        @if (isset($companies) && count($companies) > 0)
            <x-new-components.table>
                <x-new-components.table.thead class="grid-cols-[1fr_64px] sm:grid-cols-[1fr_1fr_64px]">
                    <x-new-components.table.th>
                        <span class="text-main-text font-text truncate text-sm font-semibold md:text-base">Nome da empresa</span>
                    </x-new-components.table.th>
                    <x-new-components.table.th class="hidden sm:flex">
                        <span class="text-main-text font-text truncate text-sm font-semibold md:text-base">Setor</span>
                    </x-new-components.table.th>
                    <x-new-components.table.th>
                        <span class="text-main-text font-text truncate text-sm font-semibold md:text-base"></span>
                    </x-new-components.table.th>
                </x-new-components.table.thead>
                <x-new-components.table.tbody>
                    @foreach ($companies as $company)
                        <x-new-components.table.tr wire:key="company-{{ $company['id'] }}" class="grid-cols-[1fr_64px] sm:grid-cols-[1fr_1fr_64px]" last="{{ $loop->last ? true : false }}">
                            <x-new-components.table.td>
                                <span class="text-secondary-text font-text flex-1 truncate text-sm font-normal md:text-base" title="{{ $company['register_name'] }}">{{ $company['register_name'] }}</span>      
                            </x-new-components.table.td>
                            @php
                                $department = $user['type'] === App\Enums\ReportChannel\ReportChannelUserTypes::EMPLOYEE->value ? ($company['pivot']['company_department_name'] ?? '-') : App\Enums\ReportChannel\ReportChannelUserTypes::from($user['type'])->label();
                            @endphp
                            <x-new-components.table.td class="hidden sm:flex">
                                <span class="text-secondary-text font-text flex-1 truncate text-sm font-normal md:text-base" title="{{ $department }}">{{ $department }}</span>      
                            </x-new-components.table.td>
                            <x-new-components.table.td>
                                <x-new-components.actions.button wire:click="detach({{ $company['id'] }})" slim fitSize class="!bg-danger !h-8 !w-8 !p-0" data-tippy-content="Clique para desvincular o usuário da empresa" onclick="return confirm('Tem certeza que deseja desvincular o usuário dessa empresa?')">
                                    <x-icon wire:loading.remove wire:target="detach({{ $company['id'] }})" icon="x-mark" class="text-main-background h-4 w-4 object-scale-down" />
                                    <x-icon wire:loading wire:target="detach({{ $company['id'] }})" icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                                </x-new-components.actions.button>
                            </x-new-components.table.td>
                        </x-new-components.table.tr>
                    @endforeach
                </x-new-components.table.tbody>
            </x-new-components.table>
        @else
            <div class="flex w-full items-center justify-center sm:col-span-2 lg:col-span-3">
                <p class="text-secondary-text font-text text-left text-sm font-normal md:text-base">O usuário não está vinculado a nenhuma empresa</p>
            </div>
        @endif
    </div>
</div>
