<section id="system-resources" class="flex justify-center px-3 py-12 md:px-6">
    <div class="flex w-full max-w-[850px] flex-col items-center gap-8 md:gap-12">
        <h2 class="text-main-text font-heading text-center text-2xl font-semibold md:text-3xl lg:text-4xl" data-aos="zoom-in" data-aos-duration="400" data-aos-offset="150">Recomendações</h2>

        <div class="grid w-full gap-4 md:grid-cols-2 md:gap-6 lg:gap-8">
            @include('site.home.system-resources.resource-card.index', ['icon' => 'clip', 'title' => 'Integração ao PGR', 'description' => 'Inclua os riscos psicossociais no Programa de Gerenciamento de Riscos, com mapeamento e medidas preventivas.'])
            @include('site.home.system-resources.resource-card.index', ['icon' => 'graduation-cap', 'title' => 'Treinamento de Gestores', 'description' => 'Capacite líderes e equipes de SST para aplicar a metodologia e reconhecer sinais de assédio e discriminação.'])
            @include('site.home.system-resources.resource-card.index', ['icon' => 'chart-column', 'title' => 'Validação com Indicadores', 'description' => 'Combine os resultados do questionário com dados internos e do Canal de Denúncias para análises mais robustas.'])
            @include('site.home.system-resources.resource-card.index', ['icon' => 'search-check', 'title' => 'Monitoramento Contínuo', 'description' => 'Realize auditorias periódicas com base em escores de risco, garantindo conformidade e prevenção constante.'])
        </div>
    </div>
</section>
