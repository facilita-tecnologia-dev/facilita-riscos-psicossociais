<div class="contents">
    <x-new-components.structure.page-header icon="users" label="Cadastrar Funcionário" :breadcrumbs="['Página da Empresa' => route('company.show', session('auth:company')), 'Lista de Funcionários' => route('user.index'), 'Cadastrar Funcionário' => null]" />

    <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="checkUserAlreadyExists">
        <h2 class="text-base md:text-lg text-left font-semibold text-main-text">
            1. Verifique se o usuário já está cadastrado no sistema
        </h2>

        <p class="text-sm md:text-base text-left text-main-text font-normal">
            <span class="font-semibold">Digite o CPF</span> do usuário que deseja cadastrar e <span class="font-semibold">clique em "Verificar"</span>. Se ele já estiver registrado no sistema, <span class="font-semibold">você poderá vinculá-lo diretamente à sua empresa</span>.
        </p>

        <div>
            <x-new-components.form.input-text wireModel="cpf" name="cpf" label="CPF" placeholder="Digite o cpf..." tooltip="Digite o cpf" isRequired />
        </div>

        <x-new-components.actions.button>
            <div wire:loading wire:target="checkUserAlreadyExists">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="checkUserAlreadyExists" class="font-heading text-main-background text-center text-sm font-semibold">Verificar</span>
        </x-new-components.actions.button>
    </form>

    @if($userExists === false)
        <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
            <h2 class="text-base md:text-lg text-left font-semibold text-main-text">
                2. Cadastre um novo usuário
            </h2>

            <p class="text-sm md:text-base text-left text-main-text font-normal">
               Preencha os campos abaixo para cadastrar um novo usuário no sistema. Se não tiver todas as informações no momento, informe apenas os campos obrigatórios.
            </p>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                <x-new-components.form.input-text wireModel="cpf" name="cpf" label="CPF" placeholder="Digite o cpf..." tooltip="Digite o cpf" isRequired />
                <x-new-components.form.input-text wireModel="name" name="name" label="Nome" placeholder="Digite o nome..." tooltip="Digite o nome" isRequired />
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

            <x-new-components.actions.button>
                <div wire:loading wire:target="submit">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Cadastrar</span>
            </x-new-components.actions.button>

        </form>
    @endif

    <div x-data="{ isAttachModalOpen: @entangle('userExists') }" x-show="isAttachModalOpen" x-cloak x-transition.opacity.duration.300ms x-on:invite:dispatched.window="isAttachModalOpen = false" class="bg-main-text/20 fixed inset-0 z-40 flex h-screen items-center justify-center">
        <div class="bg-main-background mx-4 flex w-full max-w-[500px] flex-col items-center gap-6 rounded-2xl p-6" @click.outside="isAttachModalOpen = false">
            <h2 class="font-heading text-main-text text-center text-lg sm:text-xl font-semibold md:text-2xl">Vincular usuário</h2>

            <p class="text-sm md:text-base text-left text-main-text font-normal">
                <span class="font-semibold">Este usuário já possui cadastro no sistema</span>. Basta definir o nível hierárquico que ele terá em sua empresa e clicar em “Vincular”.
            </p>

            <p class="text-sm md:text-base text-left text-main-text font-normal">
                Caso precise atualizar informações, <span class="font-semibold">você poderá editá-las posteriormente na página de perfil do usuário</span>.
            </p>

            <form class="w-full flex flex-col gap-4" wire:submit.prevent="attachExistingUser">
                <x-new-components.form.input-binary wireModel="role" name="role" label="Hierarquia" tooltip="Escolha o nível de hierarquia do funcionário" :options="$roles" isRequired />
    
               <x-new-components.actions.button>
                   <div wire:loading wire:target="attachExistingUser">
                       <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                   </div>
    
                   <span wire:loading.remove wire:target="attachExistingUser" class="font-heading text-main-background text-center text-sm font-semibold">Vincular</span>
               </x-new-components.actions.button>
           </form>
        </div>
    </div>
</div>

