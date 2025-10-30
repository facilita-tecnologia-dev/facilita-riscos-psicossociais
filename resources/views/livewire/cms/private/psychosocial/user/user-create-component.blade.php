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
                'Cadastrar novo funcionário' => null
            ]" 
        />
    </div>

    <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-end">
            <x-new-components.form.input-text wireModel="name" name="name" label="Nome" placeholder="Digite o nome..." tooltip="Digite o nome" isRequired />
            <x-new-components.form.input-text wireModel="cpf" name="cpf" label="CPF" placeholder="Digite o cpf..." tooltip="Digite o cpf" isRequired />
            <x-new-components.form.input-text wireModel="email" name="email" label="E-mail" placeholder="Digite o e-mail..." tooltip="Digite o e-mail" />
            <x-new-components.form.input-text wireModel="department" name="department" label="Setor" placeholder="Digite o setor..." tooltip="Digite o setor" isRequired />
            <x-new-components.form.input-text wireModel="occupation" name="occupation" label="Função" placeholder="Digite a função..." tooltip="Digite a função" isRequired />
            <x-new-components.form.input-text wireModel="workShift" name="workShift" label="Turno" placeholder="Digite o turno..." tooltip="Digite o turno" />
            <x-new-components.form.input-date wireModel="admission" name="admission" label="Data de admissão" placeholder="Escolha a data de admissão" tooltip="Escolha a data de admissão" />
            <x-new-components.form.input-date wireModel="birthDate" name="birthDate" label="Data de nascimento" placeholder="Escolha a data de nascimento" tooltip="Escolha a data de nascimento" />
            <x-new-components.form.input-text wireModel="gender" name="gender" label="Gênero" placeholder="Digite o gênero..." tooltip="Digite o gênero" />
            <x-new-components.form.input-text wireModel="maritalStatus" name="maritalStatus" label="Estado civil" placeholder="Digite o estado civil..." tooltip="Digite o estado civil" />
            <x-new-components.form.input-text wireModel="educationLevel" name="educationLevel" label="Grau de instrução" placeholder="Digite o grau de instrução..." tooltip="Digite o grau de instrução" />
            <x-new-components.form.input-binary wireModel="role" name="role" label="Hierarquia" tooltip="Escolha o nível de hierarquia do funcionário" :options="$roles" isRequired />
        </div>

        <x-new-components.actions.button>
            <div wire:loading wire:target="submit">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Cadastrar</span>
        </x-new-components.actions.button>

    </form>
</section>
