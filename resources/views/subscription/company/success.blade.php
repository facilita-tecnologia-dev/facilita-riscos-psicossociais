<x-layouts.auth>
    <div class="shadow-primary-solid/50 h-screen w-full max-w-[640px] shadow-lg sm:h-fit sm:rounded-2xl" style="box-shadow: 0px 0px 36px 24px #5ec8bc50">
        <div class="bg-secondary-background border-borders flex h-full w-full flex-col items-center justify-center gap-6 overflow-auto border px-6 py-8 shadow-sm sm:h-fit sm:justify-start sm:rounded-2xl">
            <div class="p-5 rounded-full bg-primary-solid">
                <x-icon icon="check" class="text-main-background w-12 h-12 object-scale-down" />
            </div>
            <h2 class="font-heading text-main-text text-center text-xl font-semibold">Assinatura confirmada!</h2>
            <span class="text-sm sm:text-base text-center text-main-text font-normal">
                Confirmamos o seu cadastro no sistema. A partir de agora, seu acesso à plataforma está liberado. Clique no botão abaixo para ser direcionado ao ambiente da empresa.
            </span>
            <span class="text-sm sm:text-base text-center text-secondary-text font-normal">
                Atenção: Esta página de confirmação não será exibida novamente.
            </span>

            <x-actions.button href="{{ App\Services\Auth\AuthenticationService::redirectLogoutRoute('company') }}">
                <span class="font-heading text-main-background text-center text-sm font-semibold">Acessar</span>
            </x-actions.button>
        </div>
    </div>

</x-layouts.auth>