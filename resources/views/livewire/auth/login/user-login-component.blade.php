<div class="shadow-primary-solid/50 h-screen w-full max-w-[640px] shadow-lg sm:h-fit sm:rounded-2xl" style="box-shadow: 0px 0px 36px 24px #5ec8bc50">
    <div class="bg-secondary-background border-borders flex h-full w-full flex-col items-center justify-center gap-8 overflow-auto border px-6 py-8 shadow-sm sm:h-fit sm:justify-start sm:rounded-2xl">
        <h2 class="font-heading text-main-text text-center text-xl font-semibold">Funcionário - Login</h2>

        {{-- STEP: CPF --}}
        @if ($step === \App\Livewire\Auth\Login\UserLoginComponent::STEPS['CPF'])
            <form class="grid w-full grid-cols-1 gap-4" wire:submit.prevent="submitCPF">
                <x-new-components.form.input-text wireModel="cpf" name="cpf" label="CPF" placeholder="Digite o cpf..." tooltip="Digite o cpf..." isRequired />

                {{-- <x-new-components.form.input-text wireModel="password" name="password" label="Senha" placeholder="Digite a senha..." tooltip="Digite a senha..." isRequired isPassword /> --}}

                <x-new-components.actions.button class="w-full" type="submit">
                    <div wire:loading wire:target="submitCPF">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="submitCPF" class="font-heading text-main-background text-center text-sm font-semibold">Login</span>
                </x-new-components.actions.button>
            </form>
        @endif

        {{-- STEP: SELEÇÃO DE EMPRESA --}}
        @if ($step === \App\Livewire\Auth\Login\UserLoginComponent::STEPS['SELECT_COMPANY'])
            <div class="flex flex-col gap-4">
                <p class="font-text text-main-text text-center text-sm font-normal sm:text-left sm:text-base">Você está vinculado a mais de uma empresa. Por favor, escolha abaixo em qual delas deseja se autenticar.</p>

                <div class="space-y-2">
                    @foreach ($companies as $company)
                        <div wire:click="selectCompany({{ $company['id'] }})" class="bg-secondary-background border-borders cursor-pointer rounded-sm border px-4 py-3 transition hover:brightness-95">
                            <span class="text-main-text font-heading text-left text-sm font-normal">{{ $company['name'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- STEP: SENHA TEMPORÁRIA --}}
        @if ($step === \App\Livewire\Auth\Login\UserLoginComponent::STEPS['TEMP_PASSWORD'])
            <form class="grid w-full grid-cols-1 gap-4" wire:submit.prevent="validateTemporaryPassword">
                <p class="font-text text-main-text text-center text-sm font-normal sm:text-left sm:text-base">Você ainda não possui uma senha definitiva. Acesse com sua senha provisória para criar uma nova senha.</p>

                <x-new-components.form.input-text wireModel="temp_password" name="temp_password" label="Senha Temporária" placeholder="Digite a senha temporária..." tooltip="Digite a senha temporária..." isRequired isPassword />

                <x-new-components.actions.button class="w-full" type="submit">
                    <div wire:loading wire:target="validateTemporaryPassword">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="validateTemporaryPassword" class="font-heading text-main-background text-center text-sm font-semibold">Validar</span>
                </x-new-components.actions.button>
            </form>
        @endif

        {{-- STEP: DEFINIR NOVA SENHA --}}
        @if ($step === \App\Livewire\Auth\Login\UserLoginComponent::STEPS['NEW_PASSWORD'])
            <form class="grid w-full grid-cols-1 gap-4" wire:submit.prevent="updatePassword">
                <p class="font-text text-main-text text-center text-sm font-normal sm:text-left sm:text-base">Agora, defina e confirme sua nova senha. Ela só será solicitada quando você tentar se autenticar em uma empresa na qual você atua como gestor.</p>

                <x-new-components.form.input-text wireModel="new_password" name="new_password" label="Nova Senha" placeholder="Digite a nova senha..." tooltip="Digite a nova senha" isRequired isPassword />
                <x-new-components.form.input-text wireModel="new_password_confirmation" name="new_password_confirmation" label="Confirme a nova senha" placeholder="Confirme a nova senha..." tooltip="Confirme a nova senha" isRequired isPassword />

                <x-new-components.actions.button class="w-full" type="submit">
                    <div wire:loading wire:target="updatePassword">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="updatePassword" class="font-heading text-main-background text-center text-sm font-semibold">Redefinir senha</span>
                </x-new-components.actions.button>
            </form>
        @endif

        {{-- STEP: SENHA DEFINITIVA --}}
        @if ($step === \App\Livewire\Auth\Login\UserLoginComponent::STEPS['FINAL_PASSWORD'])
            <form class="grid w-full grid-cols-1 gap-4" wire:submit.prevent="validateFinalPassword">
                <x-new-components.form.input-text wireModel="password" name="password" label="Senha" placeholder="Digite sua senha..." tooltip="Digite sua senha" isRequired isPassword />

                <x-new-components.actions.button class="w-full" type="submit">
                    <div wire:loading wire:target="validateFinalPassword">
                        <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                    </div>

                    <span wire:loading.remove wire:target="validateFinalPassword" class="font-heading text-main-background text-center text-sm font-semibold">Login</span>
                </x-new-components.actions.button>
            </form>

            <footer class="flex w-full flex-col-reverse items-center justify-between gap-4 sm:col-span-2 sm:flex-row">
                <a href="{{ route('user.login') }}" class="text-danger font-text text-left text-sm font-normal underline transition hover:scale-105">Voltar</a>
                <a href="{{ route('user.password-request') }}" class="text-primary-solid font-text text-left text-sm font-normal underline transition hover:scale-105">Esqueci minha senha</a>
            </footer>
        @endif
    </div>
</div>
