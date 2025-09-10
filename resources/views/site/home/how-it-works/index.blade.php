<section id="how-it-works" class="m-auto flex w-full max-w-[850px] flex-col items-center gap-8 px-3 py-12 md:gap-12 md:px-6">
    <h2 class="text-main-text font-heading text-center text-2xl font-semibold md:text-3xl lg:text-4xl" data-aos="zoom-in" data-aos-duration="400" data-aos-offset="150">Como funciona</h2>

    <ul class="flex flex-col items-center gap-4 md:gap-8">
        @include('site.home.how-it-works.list-item.index', ['number' => '1', 'title' => 'Registro da denúncia', 'description' => 'Processo sigiloso, com apuração da denúncia escrita, anexos e respectivas respostas.'])
        @include('site.home.how-it-works.list-item.index', ['number' => '2', 'title' => 'Definição de poderes', 'description' => 'Eleja o comitê de avaliação da sua empresa para conduzir o processo.'])
        @include('site.home.how-it-works.list-item.index', ['number' => '3', 'title' => 'Processo de análise', 'description' => 'O comitê terá acesso às informações das denúncias, para poder conduzir a investigação.'])
        @include('site.home.how-it-works.list-item.index', ['number' => '4', 'title' => 'Encerramento e resultados', 'description' => 'Solução de ocorrências com ética, transparência e conformidade.'])
    </ul>
</section>
