<x-layouts.app>
    <div class="grid grid-cols-1 items-start gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div class="bg-secondary-background border-borders flex flex-col items-start gap-4 rounded-lg border p-4 shadow-sm sm:col-span-2 sm:p-6 lg:col-span-1">
            <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                Oops! Parece que você ainda
                <span class="font-semibold">não agendou uma campanha</span>
                de Avaliação de Riscos Psicossociais — por isso
                <span class="font-semibold">o dashboard ainda não está disponível</span>
                .
            </p>

            <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                Enquanto isso, você pode aproveitar para configurar outros itens importantes:
                <span class="font-semibold">atualizar os indicadores epidemiológicos</span>
                (que tornam a avaliação mais precisa e direcionada) e
                <span class="font-semibold">revisar as medidas de controle e prevenção de riscos</span>
                .
            </p>

            <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                Para acessar essas configurações,
                <span class="font-semibold">utilize os cards disponíveis à direita</span>
                .
            </p>
        </div>

        <div class="bg-secondary-background border-borders flex flex-col items-start gap-4 rounded-lg border p-4 shadow-sm sm:p-6">
            <h2 class="text-main-text font-heading text-left text-base font-semibold sm:text-lg">Editar Indicadores Epidemiológicos</h2>

            <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                Os indicadores epidemiológicos auxiliam na avaliação dos riscos psicossociais, tornando-a mais
                <span class="font-semibold">precisa e direcionada</span>
                .
            </p>

            <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                Eles contribuem tanto para
                <span class="font-semibold">identificar perigos psicossociais específicos</span>
                quanto para
                <span class="font-semibold">direcionar a análise</span>
                desses riscos nos diferentes setores e funções da empresa.
            </p>

            {{-- TODO: Link para página de indicadores --}}
            <x-new-components.actions.button href="">
                <span class="font-heading text-main-background text-center text-sm font-semibold">Editar Indicadores Epidemiológicos</span>
            </x-new-components.actions.button>
        </div>

        <div class="bg-secondary-background border-borders flex flex-col items-start gap-4 rounded-lg border p-4 shadow-sm sm:p-6">
            <h2 class="text-main-text font-heading text-left text-base font-semibold sm:text-lg">Editar Medidas de Controle</h2>

            <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                As medidas de controle e prevenção ajudam a
                <span class="font-semibold">reduzir ou eliminar os riscos psicossociais</span>
                identificados na empresa.
            </p>

            <p class="text-main-text font-heading text-left text-sm font-normal sm:text-base">
                Elas
                <span class="font-semibold">orientam ações práticas e direcionadas para cada perigo mapeado</span>
                , garantindo um ambiente de trabalho mais seguro e saudável.
            </p>

            {{-- TODO: Link para página de medidas de controle --}}
            <x-new-components.actions.button href="">
                <span class="font-heading text-main-background text-center text-sm font-semibold">Editar Medidas de Controle</span>
            </x-new-components.actions.button>
        </div>
    </div>
</x-layouts.app>
