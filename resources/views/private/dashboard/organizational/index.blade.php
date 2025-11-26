<x-layouts.app>
    <div class="grid grid-cols-1 items-start gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div class="bg-secondary-background border-borders flex flex-col items-center gap-4 rounded-lg border p-4 shadow-sm sm:p-6">
            <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                Oops! Parece que você ainda
                <span class="font-semibold">não agendou uma campanha</span>
                de Pesquisa de Clima Organizacional — por isso
                <span class="font-semibold">o dashboard ainda não está disponível</span>
                .
            </p>

            <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                Lembre-se: se você quiser
                <span class="font-semibold">customizar o formulário da pesquisa de clima</span>
                faça-o obrigatoriamente
                <span class="font-semibold">antes do agendamento da campanha</span>
                . Uma vez agendada,
                <span class="font-semibold">qualquer alteração posterior no formulário não será considerada.</span>
            </p>

            <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                Você pode criar ou editar o formulário a qualquer momento
                <span class="font-semibold">através do card à direita</span>
                .
            </p>
        </div>

        <div class="bg-secondary-background border-borders flex flex-col items-start gap-4 rounded-lg border p-4 shadow-sm sm:p-6 lg:col-span-2">
            <h2 class="text-main-text font-heading text-left text-base font-semibold sm:text-lg">Customizar formulários de Pesquisa de Clima</h2>

            <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">Personalize os formulários para que se encaixem no contexto da sua organização. Além de modificar questões, você pode criar novos grupos de questões e até mesmo criar novos formulários completos.</p>

            {{-- TODO: Link para página de formulários --}}
            <x-new-components.actions.button href="">
                <span class="font-heading text-main-background text-center text-sm font-semibold">Acesar página de formulários</span>
            </x-new-components.actions.button>
        </div>
    </div>
</x-layouts.app>
