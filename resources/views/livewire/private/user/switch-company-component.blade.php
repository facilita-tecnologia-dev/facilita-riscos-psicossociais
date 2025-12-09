<div x-data="{ switchCompanyModalOpen: false }" x-on:open-switch-company-modal.window="switchCompanyModalOpen = true" x-on:close-switch-company-modal.window="switchCompanyModalOpen = false" class="contents">
    <button wire:click="openSwitchCompanyModal" class="cursor-pointer flex w-full items-center justify-start gap-2 rounded-sm px-3 py-1 transition hover:bg-borders text-secondary-text border-borders border bg-transparent">
        <span class="text-secondary-text text-left font-normal text-sm">Trocar de empresa</span>
    </button>

    <div x-show="switchCompanyModalOpen" x-transition.opacity x-cloak class="fixed inset-0 z-30 flex items-center justify-center bg-black/60 px-4">
        <div x-on:click.away="$wire.closeSwitchCompanyModal()" class="bg-secondary-background border-borders flex flex-col w-full max-w-xl gap-6 rounded-lg border p-6 shadow-sm">
            <div class="flex flex-col gap-4">
                <header class="flex w-full items-center justify-between">
                    <h2 class="font-heading text-main-text text-left text-base sm:text-lg font-semibold">Autenticar em outra empresa</h2>
                    <div class="cursor-pointer transition hover:scale-105" data-tippy-content="Selecione a empresa na qual deseja se autenticar. Sua sessão será atualizada e você será redirecionado para o ambiente correspondente.">
                        <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                    </div>
                </header>

                <form class="grid w-full grid-cols-1 gap-4" wire:submit.prevent="submit">
                    <x-new-components.form.select wireModel="company_id" wireModelType="live" name="company" label="Empresa" placeholder="Selecione a empresa" tooltip="Selecione a empresa" :options="$companies" isRequired />
                    
                    @if($needsPassword)
                        <span class="text-sm sm:text-base text-main-text text-left font-normal">Como você possui perfil de gestor na empresa selecionada, é necessário confirmar sua senha para avançar.</span>

                        <x-new-components.form.input-text wireModel="password" name="password" label="Senha" placeholder="Digite a sua senha..." tooltip="Digite a sua senha." isRequired isPassword />
                    @endif

                    <x-new-components.actions.button class="w-full" type="submit">
                        <div wire:loading wire:target="submit">
                            <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                        </div>

                        <span wire:loading.remove wire:target="submit" class="font-heading text-main-background text-center text-sm font-semibold">Autenticar</span>
                    </x-new-components.actions.button>
                </form>
            </div>
        </div>
    </div>
</div>

