<form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
    <x-new-components.form.input-photo wireModel="profile_photo" name="profile_photo" format="w-fit min-w-14 h-14 rounded-md" :value="$profile_photo" tooltip="Clique para adicionar uma foto de perfil" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
        <x-new-components.form.input-text wireModel="full_name" name="full_name" label="Nome completo" placeholder="Digite o nome completo..." tooltip="Digite o nome completo" isRequired />
        <x-new-components.form.input-text wireModel="cpf" name="cpf" label="CPF" placeholder="Digite o cpf..." tooltip="Você não pode alterar o CPF do usuário pois ele é um identificador único." isRequired disabled />
        <x-new-components.form.input-text wireModel="email" name="email" label="E-mail" placeholder="Digite o e-mail..." tooltip="Digite o e-mail" isRequired />
        <x-new-components.form.input-text wireModel="type" name="type" label="Tipo de usuário" placeholder="Selecione o tipo de usuário" tooltip="Você não pode alterar o tipo do usuário." isRequired disabled />
    </div>

    <x-new-components.actions.button class="!bg-report-channel-primary-solid">
        <div wire:loading wire:target="submit">
            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
        </div>

        <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Editar</span>
    </x-new-components.actions.button>

</form>