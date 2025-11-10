<section class="flex flex-col gap-6 p-4">
    <div class="space-y-3">
        <div class="flex gap-2 items-center">
            <x-icon icon="report-channel" class="w-6 h-6 object-scale-down text-report-channel-primary-solid" />
            <h1 class="text-xl md:text-2xl text-main-text font-semibold text-left">Facilita Canal de Denúncias</h1>
        </div>

        <x-new-components.structure.breadcrumbs 
            :links="[
                'Lista de usuários' => route('cms.report-channel.user.index'),
                'Cadastrar usuário' => null
            ]" 
        />
    </div>

    <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
        <x-new-components.form.input-photo wireModel="logo" name="logo" format="w-fit min-w-14 h-14 rounded-md" :value="$logo" tooltip="Clique para adicionar uma logomarca" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
            <x-new-components.form.input-text wireModel="full_name" name="full_name" label="Nome completo" placeholder="Digite o nome completo..." tooltip="Digite o nome completo" isRequired />
            <x-new-components.form.input-text wireModel="cpf" name="cpf" label="CPF" placeholder="Digite o cpf..." tooltip="Digite o cpf" isRequired />
            <x-new-components.form.input-text wireModel="email" name="email" label="E-mail" placeholder="Digite o e-mail..." tooltip="Digite o e-mail" isRequired />
            <x-new-components.form.select wireModel="type" name="type" label="Tipo de usuário" placeholder="Selecione o tipo de usuário" tooltip="Selecione o tipo de usuário" :options="$userTypes" isRequired wireModelType="live" />
            
            <x-new-components.form.input-text wireModel="password" name="password" label="Senha" placeholder="Digite a senha..." tooltip="Crie uma senha de 8 a 30 caracteres, com pelo menos uma letra maiúscula, uma letra minúscula e um caractere especial para maior segurança" isRequired isPassword />
            <x-new-components.form.input-text wireModel="password_confirmation" name="password_confirmation" label="Confirme a senha" placeholder="Confirme a senha..." tooltip="Confirme a senha que você criou" isRequired isPassword />
            
            <x-new-components.form.select wireModel="company" name="company" label="Vincular à empresa" placeholder="Selecione a empresa" tooltip="Selecione a empresa à qual você deseja vincular este usuário. Caso não queira vinculá-lo a nenhuma empresa por enquanto, selecione a opção 'Nenhuma'." :options="$companies" isRequired  wireModelType="live" />
            
            @if($type === App\Enums\ReportChannel\ReportChannelUserTypes::EMPLOYEE->value && $selectedCompanyDepartments)
                <x-new-components.form.select wireModel="department" name="department" label="Setor" placeholder="Selecione o setor" tooltip="Selecione um setor da empresa para vincular este usuário. Caso não queira vinculá-lo a nenhum setor, altere o tipo de usuário para Consultor ou Jurídico." :options="$selectedCompanyDepartments" isRequired />
            @endif

            @if($company && $type === App\Enums\ReportChannel\ReportChannelUserTypes::EMPLOYEE->value && !$selectedCompanyDepartments)
                <div class="text-sm text-secondary-text font-regular text-left">
                    <p>A empresa selecionada não possui setores cadastrados. Enquanto não houver setores, não será possível cadastrar usuários do tipo Colaborador da empresa. Cadastre setores ou vincule usuários dos tipos Consultor ou Jurídico.</p>
                </div>
            @endif
        </div>

        <x-new-components.actions.button class="!bg-report-channel-primary-solid">
            <div wire:loading wire:target="submit">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Cadastrar</span>
        </x-new-components.actions.button>

    </form>
</section>
