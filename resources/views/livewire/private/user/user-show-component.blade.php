<div class="contents">
    <x-new-components.structure.page-header icon="users" label="Página do Funcionário" :breadcrumbs="['Página da Empresa' => route('company.show', session('auth:company')), 'Lista de Funcionários' => route('user.index'), 'Página do Funcionário' => null]" />

    <livewire:private.user.user-edit-component :user="$user" />

    @if($role === App\Enums\RoleEnum::MANAGER->value)
        <livewire:private.user.user-permission-component :user="$user" />
        {{-- <livewire:private.user.user-department-scope-component :user="$user" /> TODO: DepartmentScopes --}}
    @endif
</div>