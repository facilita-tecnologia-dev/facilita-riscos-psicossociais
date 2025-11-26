<div class="shadow-primary-solid/50 h-screen w-full max-w-[640px] shadow-lg sm:h-fit sm:rounded-2xl" style="box-shadow: 0px 0px 36px 24px #5ec8bc50">
    <div class="bg-secondary-background border-borders flex h-full w-full flex-col items-center justify-center gap-8 overflow-auto border px-6 py-8 shadow-sm sm:h-fit sm:justify-start sm:rounded-2xl">
        <h2 class="font-heading text-main-text text-center text-xl font-semibold">Redefinir Senha</h2>

        <p class="font-text text-main-text text-center text-sm font-normal sm:text-left sm:text-base">Crie uma nova senha segura e confirme-a para acessar o sistema.</p>

        <form class="grid w-full grid-cols-1 gap-4" wire:submit.prevent="submit">
            <input type="hidden" wire:model.defer="token" value="{{ $token }}" />
            <input type="hidden" wire:model.defer="email" value="{{ $email }}" />

            <x-new-components.form.input-text wireModel="password" name="password" label="Senha" placeholder="Digite a senha..." tooltip="Crie uma senha de 8 a 30 caracteres, com pelo menos uma letra maiúscula, uma letra minúscula e um caractere especial para maior segurança" isRequired isPassword />
            <x-new-components.form.input-text wireModel="password_confirmation" name="password_confirmation" label="Confirme sua senha" placeholder="Confirme a senha..." tooltip="Confirme a senha que você criou" isRequired isPassword />

            <x-new-components.actions.button class="w-full" type="submit">
                <div wire:loading wire:target="submit">
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                </div>

                <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Redefinir senha</span>
            </x-new-components.actions.button>
        </form>
    </div>
</div>
