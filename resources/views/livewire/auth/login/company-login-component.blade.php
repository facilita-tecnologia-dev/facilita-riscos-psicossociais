<div class="shadow-primary-solid/50 h-screen w-full max-w-[640px] shadow-lg sm:h-fit sm:rounded-2xl" style="box-shadow: 0px 0px 36px 24px #5ec8bc50">
    <div class="bg-secondary-background border-borders flex h-full w-full flex-col items-center justify-center gap-8 overflow-auto border px-6 py-8 shadow-sm sm:h-fit sm:justify-start sm:rounded-2xl">
        <h2 class="font-heading text-main-text text-center text-xl font-semibold">Empresa - Login</h2>

        <form class="grid w-full grid-cols-1 gap-4" wire:submit.prevent="submit">
            <x-new-components.form.input-text wireModel="cnpj" name="cnpj" label="CNPJ" placeholder="Digite o cnpj..." tooltip="Digite o cnpj da empresa" isRequired />
            <x-new-components.form.input-text wireModel="password" name="password" label="Senha" placeholder="Digite a senha..." tooltip="Digite a senha da empresa" isRequired isPassword />

            @if (session('login:incorrect'))
                <footer class="flex w-full items-center justify-between gap-3 pl-0.5">
                    <span class="text-danger font-text text-left text-xs leading-4 font-normal">{{ session('login:incorrect') }}</span>
                </footer>
            @endif

            <x-new-components.actions.button class="w-full" type="submit">
                <div wire:loading wire:target="submit">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Login</span>
            </x-new-components.actions.button>
        </form>

        <footer class="flex w-full flex-col-reverse items-center justify-between gap-4 sm:col-span-2 sm:flex-row">
            <a href="{{ route('company.register') }}" class="text-main-text font-text text-left text-sm font-normal transition hover:scale-105">
                Não tem uma conta?
                <span class="text-primary-solid underline">Cadastro</span>
            </a>
            <a href="{{ route('company.password.request') }}" class="text-primary-solid font-text text-left text-sm font-normal underline transition hover:scale-105">Esqueci minha senha</a>
        </footer>
    </div>
</div>
