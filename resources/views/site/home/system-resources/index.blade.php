<section id="system-resources" class="bg-secondary-background flex justify-center px-3 py-12 md:px-6">
    <div class="flex w-full max-w-[850px] flex-col items-center gap-8 md:gap-12">
        <h2 class="text-main-text font-heading text-center text-2xl font-semibold md:text-3xl lg:text-4xl" data-aos="zoom-in" data-aos-duration="400" data-aos-offset="150">Recursos</h2>

        <div class="grid w-full gap-4 md:grid-cols-2 md:gap-6 lg:gap-8">
            @include('site.home.system-resources.resource-card.index', ['icon' => 'dashboard-layout', 'title' => 'Dashboard com estatísticas', 'description' => ' Análise das denúncias, classificação por motivo, período, tipos e mais...'])
            @include('site.home.system-resources.resource-card.index', ['icon' => 'document-check', 'title' => 'Formalização dos registros', 'description' => 'Relatórios detalhados sobre todas as etapas do processo de denúncia.'])
            @include('site.home.system-resources.resource-card.index', ['icon' => 'shield-check', 'title' => 'Segurança Jurídica', 'description' => 'Conformidade com normas e redução de passivos trabalhistas.'])
            @include('site.home.system-resources.resource-card.index', ['icon' => 'handshake', 'title' => 'Integridade no processo', 'description' => 'Transparência e garantia do anonimato durante todo o processo.'])
        </div>
    </div>
</section>
