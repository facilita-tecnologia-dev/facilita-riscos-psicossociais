<section id="system-resources" class="bg-secondary-background flex justify-center px-3 py-12 md:px-6">
    <div class="flex w-full max-w-[850px] flex-col items-center gap-8 md:gap-12">
        <h2 class="text-main-text font-heading text-center text-2xl font-semibold md:text-3xl lg:text-4xl" data-aos="zoom-in" data-aos-duration="400" data-aos-offset="150">Recursos</h2>

        <div class="grid w-full gap-4 md:grid-cols-2 md:gap-6 lg:gap-8">
            @include('site.home.system-resources.resource-card.index', ['icon' => 'chart-column', 'title' => 'Avaliação Completa', 'description' => ' Cobre HSE-IT, ISO 45003, EU-OSHA, NR-01 e leis nacionais.'])
            @include('site.home.system-resources.resource-card.index', ['icon' => 'shield-check', 'title' => 'Proteção de Dados', 'description' => 'Segurança e confidencialidade em cada etapa do processo.'])
            @include('site.home.system-resources.resource-card.index', ['icon' => 'document-check', 'title' => 'Relatórios Inteligentes', 'description' => 'Classificação automática de riscos: Baixo a Crítico.'])
            @include('site.home.system-resources.resource-card.index', ['icon' => 'wire-connection', 'title' => 'Integração com Denúncias', 'description' => 'Complemento com indicadores do Canal de Denúncias.'])
        </div>
    </div>
</section>
