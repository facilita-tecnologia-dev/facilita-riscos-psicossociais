<div class="shadow-primary-solid/50 h-screen w-full max-w-[640px] shadow-lg sm:h-fit sm:rounded-2xl" style="box-shadow: 0px 0px 36px 24px #5ec8bc50">
    <div class="bg-secondary-background border-borders flex h-full w-full flex-col items-center justify-center gap-8 overflow-auto border px-6 py-8 shadow-sm sm:h-fit sm:justify-start sm:rounded-2xl">
        <h2 class="font-heading text-main-text text-center text-xl font-semibold">Redefinir Senha</h2>

        <p class="font-text text-main-text text-center text-sm font-normal sm:text-left sm:text-base">Digite seu e-mail para receber um link de redefinição de senha.</p>

        <form class="grid w-full grid-cols-1 gap-4" wire:submit.prevent="submit">
            <x-form.input-text wireModel="email" name="email" label="E-mail" placeholder="Digite o e-mail..." tooltip="Digite o e-mail da empresa" isRequired />

            <x-actions.button class="w-full" type="submit">
                <div wire:loading wire:target="submit">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Enviar link</span>
            </x-actions.button>
        </form>

        <footer class="flex w-full justify-center">
            <a href="{{ route('company.login') }}" class="text-main-text font-text text-left text-sm font-normal transition hover:scale-105">
                Lembrou sua senha?
                <span class="text-primary-solid underline">Login</span>
            </a>
        </footer>
    </div>
</div>
