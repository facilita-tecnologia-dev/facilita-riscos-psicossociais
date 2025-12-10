<div class="shadow-primary-solid/50 h-screen w-full max-w-[640px] shadow-lg sm:h-fit sm:rounded-2xl" style="box-shadow: 0px 0px 36px 24px #5ec8bc50">
    <div class="bg-secondary-background border-borders flex h-full w-full flex-col items-center justify-center gap-8 overflow-auto border px-6 py-8 shadow-sm sm:h-fit sm:justify-start sm:rounded-2xl">
        <h2 class="font-heading text-main-text text-center text-xl font-semibold">Cadastro de empresa</h2>

        <form class="grid w-full grid-cols-1 items-start gap-4 sm:grid-cols-2" wire:submit.prevent="submit">
            <x-new-components.form.input-text wireModel="name" name="name" label="Razão Social" placeholder="Digite a razão social..." tooltip="Digite a razão social da empresa" isRequired />
            <x-new-components.form.input-text wireModel="cnpj" name="cnpj" label="CNPJ" placeholder="Digite o CNPJ..." tooltip="Digite o CNPJ da empresa" isRequired />

            <div class="sm:col-span-2">
                <x-new-components.form.input-text wireModel="email" name="email" label="E-mail" placeholder="Digite o e-mail..." tooltip="Digite o e-mail da empresa" isRequired />
            </div>

            <x-new-components.form.input-text wireModel="password" name="password" label="Senha" placeholder="Digite a senha..." tooltip="Crie uma senha de 8 a 30 caracteres, com pelo menos uma letra maiúscula, uma letra minúscula e um caractere especial para maior segurança" isRequired isPassword />
            <x-new-components.form.input-text wireModel="password_confirmation" name="password_confirmation" label="Confirme sua senha" placeholder="Confirme a senha..." tooltip="Confirme a senha que você criou" isRequired isPassword />

            <x-new-components.actions.button class="w-full sm:col-span-2" type="submit">
                <div wire:loading wire:target="submit">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Cadastro</span>
            </x-new-components.actions.button>
        </form>

        <footer class="flex w-full items-center justify-center gap-4">
            <a href="{{ route('company.login') }}" class="text-main-text font-text text-left text-sm font-normal transition hover:scale-105">
                Já tem uma conta?
                <span class="text-primary-solid underline">Fazer login</span>
            </a>
        </footer>

        <a href="{{ route('site.home') }}" class="text-secondary-text font-text text-left text-sm font-normal underline transition hover:scale-105">Voltar para a Home</a>
    </div>
</div>
