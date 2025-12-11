<div class="contents">
    <x-new-components.structure.page-header icon="users" label="Página do Funcionário" :breadcrumbs="['Página da Empresa' => route('company.show', session('auth:company')), 'Lista de Funcionários' => route('user.index'), 'Página do Funcionário' => null]" />
        
    @if(session('auth:guard') === 'user' && $user->id === session('auth:user')->id)
        <livewire:private.user.user-info-component :user="$user" />

        @if($isManager)
            <livewire:private.user.user-reset-password-component />
        @endif
    @else
        <livewire:private.user.user-edit-component :user="$user" />

        @if($isManager)
            <livewire:private.user.user-permission-component :user="$user" />
            <livewire:private.user.user-department-scope-component :user="$user" />
        @endif
    @endif
</div>