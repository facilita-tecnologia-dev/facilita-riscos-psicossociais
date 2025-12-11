<form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
    <header class="flex items-center justify-between">
        <h2 class="text-base md:text-lg text-left font-semibold text-main-text">
            Meu Perfil
        </h2>

        <div class="flex items-center gap-2.5">
            @if($status == App\Enums\User\UserStatus::ACTIVE->value)
                <div class="flex items-center gap-1.5">
                    <span class="hidden sm:block text-sm text-secondary-text font-normal text-right">Ativado</span>
                    <div class="w-3 h-3 bg-primary-solid rounded-full animate-pulse"></div>
                </div>
            @endif
            
            @if($status == App\Enums\User\UserStatus::INACTIVE->value)
                <div class="flex items-center gap-1.5">
                    <span class="hidden sm:block text-sm text-secondary-text font-normal text-right">Inativado</span>
                    <div class="w-3 h-3 bg-danger rounded-full animate-pulse"></div>
                </div>
            @endif

            @if($role == App\Enums\User\UserRole::MANAGER->value)
                <div class="flex items-center gap-1.5">
                    <span class="hidden sm:block text-sm text-secondary-text font-normal text-right">Gestor</span>
                    <x-icon icon="work" class="w-5 h-5 object-scale-downt text-secondary-text" />
                </div>
            @endif
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
        <x-info-item label="Nome" value="{{ $user->name }}" truncate />
        <x-info-item label="CPF" value="{{ $user->cpf }}" truncate />
        <x-info-item label="E-mail" value="{{ $user->email }}" truncate />
        <x-info-item label="Setor" value="{{ $user->department }}" truncate />
        <x-info-item label="Função" value="{{ $user->occupation }}" truncate />
        <x-info-item label="Turno" value="{{ $user->work_shift }}" truncate />
        <x-info-item label="Data de admissão" value="{{ $user->admission }}" truncate />
        <x-info-item label="Data de nascimento" value="{{ $user->birth_date }}" truncate />
        <x-info-item label="Gênero" value="{{ $user->gender }}" truncate />
        <x-info-item label="Estado civil" value="{{ $user->marital_status }}" truncate />
        <x-info-item label="Grau de instrução" value="{{ $user->education_level }}" truncate />
    </div>
</form>

