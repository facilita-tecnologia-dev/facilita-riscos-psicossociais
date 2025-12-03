<div class="contents" x-data="{ resetPasswordModalOpen: false }" x-on:open-report-modal.window="resetPasswordModalOpen = true" x-on:close-report-modal.window="resetPasswordModalOpen = false">
    <div class="bg-secondary-background border-borders flex flex-col items-center gap-2 rounded-lg border px-6 py-4 shadow-sm sm:flex-row">
        <div class="flex flex-1 flex-col items-center gap-2 sm:items-start sm:gap-0.5">
            <h2 class="font-heading text-main-text text-center text-base font-semibold sm:text-left sm:text-lg">Redefinir senha</h2>
            <span class="font-text text-main-text text-center text-xs font-normal sm:text-left sm:text-sm">Você pode redefinir sua senha diretamente pelo modal de redefinição.</span>
        </div>

        <x-new-components.actions.button wire:click="openResetPasswordModal" fitSize>
            <span class="text-main-background font-heading text-center text-sm font-semibold">Redefinir senha</span>
        </x-new-components.actions.button>
    </div>

    <div x-show="resetPasswordModalOpen" x-transition.opacity x-cloak class="fixed inset-0 z-30 flex items-center justify-center bg-black/60 px-4">
        <div x-on:click.away="$wire.closeResetPasswordModal()" class="bg-secondary-background border-borders flex flex-col gap-4 w-full max-w-xl rounded-lg border p-6 shadow-sm">
            <header class="flex w-full items-center justify-between">
                <h2 class="font-heading text-main-text text-left text-base sm:text-lg font-semibold">Redefinir Senha</h2>
                <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Nesta seção, você pode exportar um Inventário de Riscos Psicossociais já gerado. Caso deseje criar um novo inventário com as medidas de controle atualizadas, utilize a seção à direita.">
                    <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                </div>
            </header>

            <form class="grid w-full grid-cols-1 gap-4" wire:submit.prevent="submit">
                <x-new-components.form.input-text wireModel="password" name="password" label="Senha atual" placeholder="Digite a senha atual..." tooltip="Digite a senha atual da empresa." isRequired isPassword />

                <x-new-components.form.input-text wireModel="new_password" name="new_password" label="Nova senha" placeholder="Digite a nova senha..." tooltip="Crie uma senha de 8 a 30 caracteres, com pelo menos uma letra maiúscula, uma letra minúscula e um caractere especial para maior segurança" isRequired isPassword />
                <x-new-components.form.input-text wireModel="new_password_confirmation" name="new_password_confirmation" label="Confirme sua nova senha" placeholder="Confirme a senha..." tooltip="Confirme a senha que você criou" isRequired isPassword />

                <x-new-components.actions.button class="w-full" type="submit">
                    <div wire:loading wire:target="submit">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Redefinir senha</span>
                </x-new-components.actions.button>
            </form>
        </div>
    </div>
</div>
