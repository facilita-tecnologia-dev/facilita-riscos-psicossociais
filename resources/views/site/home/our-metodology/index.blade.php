<section id="our-metodology" class="bg-secondary-background flex h-fit justify-center px-3 py-12 md:px-6">
    <div class="flex w-full max-w-[1180px] flex-col items-center gap-8 md:gap-12">
        <div class="flex flex-col items-center gap-4">
            <h2 class="text-main-text font-heading text-center text-2xl font-semibold md:text-3xl lg:text-4xl" data-aos="zoom-in" data-aos-duration="400" data-aos-offset="150">Nossa metodologia</h2>
            <p class="text-sm md:text-base text-center text-main-text font-text font-normal">O questionário foi desenvolvido para avaliar riscos psicossociais no trabalho, com foco em estresse, assédio moral, assédio sexual, discriminação e outras formas de violência, alinhado à metodologias como o HSE-IT e outras metodologias reconhecidas internacionalmente.</p>
        </div>

        <div class="w-full space-y-4">
            <header class="w-full flex justify-center">
                <div class="flex items-center gap-1.5 animate-scroll-horizontal">
                    <x-icon icon="cursor-scroll-horizontal" class="w-fit h-10 object-scale-down text-primary-solid" />
                    <span class="bg-primary-solid p-1.5 inline-block rounded-sm text-main-background text-xs">Arraste para os lados</span>
                </div>
            </header>

            <div class="w-full swiper our-metodology-swiper cursor-grab active:cursor-grabbing">
                <div class="swiper-wrapper">
                    @include('site.home.our-metodology.metodology-card.index', [
                        'title' => 'HSE-IT',
                        'mainRequirements' => 'Questionário distribuídos em 7 dimensões: Demandas (sobrecarga, prazos), Controle (autonomia, flexibilidade), Apoio da Chefia (incentivo, suporte), Apoio dos Colegas (ajuda, colaboração), Relacionamentos (conflitos, tensões), Cargo (clareza de papéis/objetivos) e Comunicação/Mudanças (transparência em alterações).',
                        'coverage' => 'Total',
                        'coverageList' => [
                            'Demandas',
                            'Controle',
                            'Apoio da Chefia',
                            'Apoio dos Colegas',
                            'Relacionamentos',
                            'Cargo',
                            'Comunicação/Mudanças',
                        ]
                    ])
                    @include('site.home.our-metodology.metodology-card.index', [
                        'title' => 'ISO 45003',
                        'mainRequirements' => 'Diretrizes para gerenciar riscos psicossociais em sistemas baseados na ISO 45001. Exige identificação de perigos em: organização do trabalho (cargas, controle, mudanças), relações sociais (suporte, assédio, violência), ambiente (isolamento, insegurança). Requer avaliação, planejamento, monitoramento e prevenção (ex.: baseline scan, controles).',
                        'coverage' => 'Total',
                        'coverageList' => [
                            'Organização do Trabalho',
                            'Relações Sociais',
                            'Ambiente',
                            'Monitoramento/Prevenção',
                        ]
                    ])
                    @include('site.home.our-metodology.metodology-card.index', [
                        'title' => 'EU-OSHA',
                        'mainRequirements' => 'Framework para avaliar riscos como cargas excessivas, demandas conflitantes, falta de clareza, insegurança, comunicação ineficaz, falta de suporte, assédio (psicológico/sexual), violência, estresse e burnout. Ferramentas como ESENER e OSH Pulse enfatizam identificação, prevenção e impacto organizacional (absenteísmo, turnover).',
                        'coverage' => 'Total',
                        'coverageList' => [
                            'Cargas/Conflitos',
                            'Suporte/Comunicação',
                            'Assédio/Violência',
                            'Estresse/Burnout',
                            'Impactos',
                        ]
                    ])
                    @include('site.home.our-metodology.metodology-card.index', [
                        'title' => 'NR-01',
                        'mainRequirements' => 'Atualização da NR 01 exige inclusão de riscos psicossociais no PGR a partir de maio 2025. Requer avaliar estresse, assédio, carga mental; classificar riscos; implementar medidas preventivas. Integra com SST geral.',
                        'coverage' => 'Total',
                        'coverageList' => [
                            'Estresse/Assédio',
                            'Carga Mental',
                            'Classificação/Prevenção',
                        ]
                    ])
                    @include('site.home.our-metodology.metodology-card.index', [
                        'title' => 'Lei nº 14.457/2022',
                        'mainRequirements' => 'Protege mulheres, especialmente em teletrabalho, exigindo avaliação de riscos como isolamento, estresse e assédio. Integra com PGR para prevenir danos mentais.',
                        'coverage' => 'Total',
                        'coverageList' => [
                            'Isolamento',
                            'Estresse',
                            'Assédio',
                        ]
                    ])
                    @include('site.home.our-metodology.metodology-card.index', [
                        'title' => 'Convenção 190 da OIT',
                        'mainRequirements' => 'Exige leis para prevenir assédio e violência (física/psicológica, incluindo de gênero) no trabalho, com avaliação de riscos, monitoramento, proteção a vítimas e políticas empresariais.',
                        'coverage' => 'Total',
                        'coverageList' => [
                            'Assédio/Violência',
                            'Impactos',
                            'Monitoramento',
                        ]
                    ])
                </div>
            </div>
        </div>
    </div>
</section>
