<form class="flex w-full flex-col items-start gap-4" wire:submit.prevent="submit">
    <x-new-components.form.input-text wireModel="user" name="user" label="Usuário" placeholder="Digite o usuário..." tooltip="Digite o usuário" isRequired />

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

        <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Fazer login</span>
    </x-new-components.actions.button>
</form>

