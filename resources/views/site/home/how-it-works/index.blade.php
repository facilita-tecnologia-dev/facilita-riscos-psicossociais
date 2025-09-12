<section id="how-it-works" class="m-auto flex w-full max-w-[850px] flex-col items-center gap-8 px-3 py-12 md:gap-12 md:px-6">
    <h2 class="text-main-text font-heading text-center text-2xl font-semibold md:text-3xl lg:text-4xl" data-aos="zoom-in" data-aos-duration="400" data-aos-offset="150">Como funciona</h2>

    <ul class="flex flex-col items-center gap-4 md:gap-8">
        @include('site.home.how-it-works.list-item.index', ['number' => '1', 'title' => 'Diagnóstico Inicial', 'description' => 'Aplicação do questionário de Riscos Psicossociais.'])
        @include('site.home.how-it-works.list-item.index', ['number' => '2', 'title' => 'Análise Estruturada', 'description' => 'Classificação de riscos conforme normas e metodologias internacionais.'])
        @include('site.home.how-it-works.list-item.index', ['number' => '3', 'title' => 'Plano de Prevenção', 'description' => 'Definição de medidas preventivas alinhadas ao PGR e diretrizes legais.'])
        @include('site.home.how-it-works.list-item.index', ['number' => '4', 'title' => 'Monitoramento Contínuo', 'description' => 'Acompanhamento de resultados com relatórios periódicos e auditorias.'])
    </ul>
</section>
