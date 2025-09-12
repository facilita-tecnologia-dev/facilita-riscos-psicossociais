<section class="m-auto flex w-full max-w-[1180px] flex-col items-center gap-8 px-3 py-12 md:gap-12 md:px-6">
    <h2 class="text-main-text font-heading text-center text-2xl font-semibold md:text-3xl lg:text-4xl" data-aos="zoom-in" data-aos-duration="400" data-aos-offset="150">Por que escolher a Facilita?</h2>

    <div class="flex w-full flex-col items-start gap-4 md:flex-row md:gap-6 lg:gap-8">
        @include('site.home.why-choose-us.card-item.index', ['icon' => 'scroll-paper', 'title' => 'Garante conformidade legal completa'])
        @include('site.home.why-choose-us.card-item.index', ['icon' => 'regulamentation', 'title' => 'Reduz riscos trabalhistas e jurídicos'])
        @include('site.home.why-choose-us.card-item.index', ['icon' => 'shield-check', 'title' => 'Previne problemas antes que ocorram'])
        @include('site.home.why-choose-us.card-item.index', ['icon' => 'heart-handshake', 'title' => 'Constrói ambientes saudáveis e seguros'])
    </div>
</section>
