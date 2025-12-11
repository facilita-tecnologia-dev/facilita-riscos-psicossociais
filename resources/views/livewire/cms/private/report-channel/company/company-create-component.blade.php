<section class="flex flex-col gap-6 p-4">
    <div class="space-y-3">
        <div class="flex gap-2 items-center">
            <x-icon icon="report-channel" class="w-6 h-6 object-scale-down text-report-channel-primary-solid" />
            <h1 class="text-xl md:text-2xl text-main-text font-semibold text-left">Facilita Canal de Denúncias</h1>
        </div>

        <x-structure.breadcrumbs 
            :links="[
                'Lista de empresas' => route('cms.report-channel.company.index'),
                'Cadastrar nova empresa' => null
            ]" 
        />
    </div>

    <form class="bg-secondary-background border-borders flex flex-col gap-4 rounded-lg border p-4 shadow-sm md:p-6" wire:submit.prevent="submit">
        <x-form.input-photo wireModel="logo" name="logo" format="w-fit min-w-14 h-14 rounded-md" :value="$logo" tooltip="Clique para adicionar uma logomarca" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
            <x-form.input-text wireModel="register_name" name="register_name" label="Razão social" placeholder="Digite a razão social..." tooltip="Digite a razão social" isRequired />
            <x-form.input-text wireModel="trade_name" name="trade_name" label="Nome fantasia" placeholder="Digite o nome fantasia..." tooltip="Digite o nome fantasia" />
            <x-form.input-text wireModel="cnpj" name="cnpj" label="CNPJ" placeholder="Digite o cnpj..." tooltip="Digite o cnpj" isRequired />
            <x-form.input-text wireModel="contact_phone" name="contact_phone" label="Telefone" placeholder="Digite o telefone..." tooltip="Digite o telefone" isRequired />
            <x-form.input-text wireModel="email" name="email" label="E-mail" placeholder="Digite o e-mail..." tooltip="Digite o e-mail" isRequired />
            <x-form.input-text wireModel="site_url" name="site_url" label="URL do Site" placeholder="Digite a url do site..." tooltip="Digite a url do site" prefix="http://" />

            <x-form.input-text wireModel="password" name="password" label="Senha" placeholder="Digite a senha..." tooltip="Crie uma senha de 8 a 30 caracteres, com pelo menos uma letra maiúscula, uma letra minúscula e um caractere especial para maior segurança" isRequired isPassword />
            <x-form.input-text wireModel="password_confirmation" name="password_confirmation" label="Confirme a senha" placeholder="Confirme a senha..." tooltip="Confirme a senha que você criou" isRequired isPassword />
        </div>

        <x-actions.button class="!bg-report-channel-primary-solid">
            <div wire:loading wire:target="submit">
                <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
            </div>

            <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Cadastrar</span>
        </x-actions.button>

    </form>
</section>
