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

            <div class="w-full flex flex-col gap-3">
                <p class="text-sm font-semibold text-main-text text-left">O que vem a seguir:</p>
                <ol class="flex flex-col gap-2">
                    <li class="flex items-start gap-3">
                        <span class="bg-primary-solid text-main-background text-xs font-semibold rounded-full w-5 h-5 flex items-center justify-center shrink-0 mt-0.5">1</span>
                        <span class="text-sm text-main-text font-normal">Adicionar a <span class="font-semibold">logomarca</span> da empresa para personalizar relatórios</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-primary-solid text-main-background text-xs font-semibold rounded-full w-5 h-5 flex items-center justify-center shrink-0 mt-0.5">2</span>
                        <span class="text-sm text-main-text font-normal"><span class="font-semibold">Importar os funcionários</span> que participarão das pesquisas</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-primary-solid text-main-background text-xs font-semibold rounded-full w-5 h-5 flex items-center justify-center shrink-0 mt-0.5">3</span>
                        <span class="text-sm text-main-text font-normal"><span class="font-semibold">Agendar a primeira campanha</span> de avaliação de riscos psicossociais.</span>
                    </li>
                </ol>
                <p class="text-xs text-secondary-text text-left">O sistema irá guiá-lo por cada uma dessas etapas assim que você acessar.</p>
            </div>

            <span class="text-sm sm:text-base text-center text-secondary-text font-normal">
                Atenção: Esta página de confirmação não será exibida novamente.
            </span>

            <x-actions.button href="{{ App\Services\Auth\AuthenticationService::redirectLogoutRoute('company') }}">
                <span class="font-heading text-main-background text-center text-sm font-semibold">Acessar</span>
            </x-actions.button>
        </div>
    </div>

</x-layouts.auth>
