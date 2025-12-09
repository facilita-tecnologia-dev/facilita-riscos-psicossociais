<section class="flex flex-col gap-6 p-4">
    <div class="space-y-3">
        <div class="flex gap-2 items-center">
            <x-icon icon="psychosocial" class="w-6 h-6 object-scale-down text-primary-solid" />
            <h1 class="text-xl md:text-2xl text-main-text font-semibold text-left">Facilita Riscos Psicossociais</h1>
        </div>

        <x-new-components.structure.breadcrumbs 
            :links="[
                'Lista de empresas' => route('cms.psychosocial.company.index'),
                $company->name => route('cms.psychosocial.company.show', $company),
                'Lista de funcionários' => route('cms.psychosocial.user.index', $company),
                $user->name => null
            ]" 
        />
    </div>

    <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
        <header class="flex items-center justify-between">
            <h2 class="text-base md:text-lg text-left font-semibold text-main-text">
                Perfil do funcionário
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

        @if($user['is_temp_password'] && ($user->role($company)['type'] == App\Enums\User\UserRole::MANAGER->value))
            <button type="button" onclick="navigator.clipboard.writeText('{{ $user['password'] }}')" wire:click='copyTempPasswordToClipboard' class="px-4 py-2 bg-primary-solid/20 border border-primary-solid rounded-md cursor-pointer flex items-start flex-col gap-1" data-tippy-content="Clique para copiar a senha temporária">
                <p class="text-sm text-left text-main-text font-normal">Este usuário possui perfil de gestor e ainda não definiu uma senha. Uma senha temporária foi criada e deverá ser redefinida no próximo acesso ao sistema.</p>
                <span class="text-sm text-left text-main-text font-normal">Senha temporária: {{ $user['password'] }}</span>
            </button>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
            <x-new-components.form.input-text wireModel="name" name="name" label="Nome" placeholder="Digite o nome..." tooltip="Digite o nome" isRequired />
            <x-new-components.form.input-text wireModel="cpf" name="cpf" label="CPF" placeholder="Digite o cpf..." tooltip="Digite o cpf" isRequired />
            <x-new-components.form.input-text wireModel="email" name="email" label="E-mail" placeholder="Digite o e-mail..." tooltip="Digite o e-mail" />
            <x-new-components.form.input-text wireModel="department" name="department" label="Setor" placeholder="Digite o setor..." tooltip="Digite o setor" isRequired />
            <x-new-components.form.input-text wireModel="occupation" name="occupation" label="Função" placeholder="Digite a função..." tooltip="Digite a função" isRequired />
            <x-new-components.form.input-text wireModel="work_shift" name="work_shift" label="Turno" placeholder="Digite o turno..." tooltip="Digite o turno" />
            <x-new-components.form.input-date wireModel="admission" name="admission" label="Data de admissão" placeholder="Escolha a data de admissão" tooltip="Escolha a data de admissão" />
            <x-new-components.form.input-date wireModel="birth_date" name="birth_date" label="Data de nascimento" placeholder="Escolha a data de nascimento" tooltip="Escolha a data de nascimento" />
            <x-new-components.form.input-text wireModel="gender" name="gender" label="Gênero" placeholder="Digite o gênero..." tooltip="Digite o gênero" />
            <x-new-components.form.input-text wireModel="marital_status" name="marital_status" label="Estado civil" placeholder="Digite o estado civil..." tooltip="Digite o estado civil" />
            <x-new-components.form.input-text wireModel="education_level" name="education_level" label="Grau de instrução" placeholder="Digite o grau de instrução..." tooltip="Digite o grau de instrução" />
            <x-new-components.form.input-binary wireModel="role" name="role" label="Hierarquia" tooltip="Escolha o nível de hierarquia do funcionário" :options="$roles" isRequired />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <x-new-components.actions.button class="lg:col-span-2">
                <div wire:loading wire:target="submit">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>
    
                <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Salvar</span>
            </x-new-components.actions.button>

            @if($status == App\Enums\User\UserStatus::ACTIVE->value)
                <x-new-components.actions.button class="!bg-danger" type="button" wire:click='inactivateUser'>
                    <div wire:loading wire:target="inactivateUser">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>
        
                    <span wire:loading.remove wire:target="inactivateUser" class="font-heading text-main-background text-center text-sm font-semibold">Inativar</span>
                </x-new-components.actions.button>
            @endif

            @if($status == App\Enums\User\UserStatus::INACTIVE->value)
                <x-new-components.actions.button type="button" wire:click='activateUser'>
                    <div wire:loading wire:target="activateUser">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>
        
                    <span wire:loading.remove wire:target="activateUser" class="font-heading text-main-background text-center text-sm font-semibold">Ativar</span>
                </x-new-components.actions.button>
            @endif
        </div>

    </form>
</section>
