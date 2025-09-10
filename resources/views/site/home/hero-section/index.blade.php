<section id="hero-section" class="relative flex w-full flex-col items-center justify-center gap-4 px-3 pt-[132px] pb-8 sm:px-6 md:gap-6 md:pt-[152px]">
    <div class="absolute top-0 left-0 h-full w-full">
        <img src="{{ asset('assets/hero-section-background.svg') }}" aria-hidden="true" class="h-full w-full object-cover" />
    </div>

    {{-- Caption --}}
    <div class="relative flex flex-col gap-1 md:gap-2">
        <p class="font-heading text-main-text text-center text-lg font-semibold sm:text-xl md:text-2xl lg:text-3xl">Facilita Riscos Psicossociais</p>
        <h1 class="font-heading text-main-text flex pb-2 text-center text-2xl leading-10 font-semibold sm:text-3xl md:text-4xl lg:text-5xl">
            <span id="animated-title">&nbsp;</span>
        </h1>
    </div>

    {{-- Videos --}}
    <div class="relative flex w-full max-w-[650px] flex-col items-center gap-2">
        <div class="swiper w-[320px] sm:w-[450px] md:w-[530px]">
            <div class="swiper-wrapper">
                <div class="swiper-slide h-full !w-fit" data-video="{{ asset('assets/site/realizando-denuncia.mp4') }}">
                    <button class="bg-main-background border-borders rounded-lg border-3 px-4 py-2 shadow-sm">
                        <span class="font-text text-main-text text-center text-xs font-normal sm:text-sm">Responder testes</span>
                    </button>
                </div>
                <div class="swiper-slide h-full !w-fit" data-video="{{ asset('assets/site/consultando-denuncia.mp4') }}">
                    <button class="bg-main-background border-borders rounded-lg border-3 px-4 py-2 shadow-sm">
                        <span class="font-text text-main-text text-center text-xs font-normal sm:text-sm">Visualizar resultados</span>
                    </button>
                </div>
                <div class="swiper-slide h-full !w-fit" data-video="{{ asset('assets/site/acompanhamento-denuncia.mp4') }}">
                    <button class="bg-main-background border-borders rounded-lg border-3 px-4 py-2 shadow-sm">
                        <span class="font-text text-main-text text-center text-xs font-normal sm:text-sm">Gerenciar Plano de Ação</span>
                    </button>
                </div>
                <div class="swiper-slide h-full !w-fit" data-video="{{ asset('assets/site/desvinculando-membro.mp4') }}">
                    <button class="bg-main-background border-borders rounded-lg border-3 px-4 py-2 shadow-sm">
                        <span class="font-text text-main-text text-center text-xs font-normal sm:text-sm">Gerenciar colaboradores</span>
                    </button>
                </div>
                {{-- <div class="swiper-slide h-full !w-fit" data-video="{{ asset('assets/site/convidando-usuario.mp4') }}">
                    <button class="bg-main-background border-borders rounded-lg border-3 px-4 py-2 shadow-sm">
                        <span class="font-text text-main-text text-center text-xs font-normal sm:text-sm">Convidar usuário para o comitê</span>
                    </button>
                </div> --}}
            </div>
        </div>

        <div class="flex h-[200px] gap-2 sm:h-[230px] md:h-[275px]">
            <button class="custom-prev bg-main-background border-borders hidden w-[45px] cursor-pointer items-center justify-center rounded-lg border-3 shadow-sm transition hover:scale-[102%] sm:flex">
                <x-icon icon="double-chevron-left" class="text-secondary-text h-6 w-6 object-scale-down" />
            </button>
            <div id="main-video" class="border-borders w-[340px] flex-1 cursor-help overflow-hidden rounded-xl border-3 transition hover:scale-[102%] sm:w-[450px] md:w-[530px]">
                <video id="video-canvas" src="{{ asset('assets/site/realizando-denuncia.mp4') }}" class="h-full w-full object-cover" autoplay></video>
            </div>
            <button class="custom-next bg-main-background border-borders hidden w-[45px] cursor-pointer items-center justify-center rounded-lg border-3 shadow-sm transition hover:scale-[102%] sm:flex">
                <x-icon icon="double-chevron-right" class="text-secondary-text h-6 w-6 object-scale-down" />
            </button>
        </div>
    </div>

    {{-- Regulations --}}
    <div class="relative flex w-full max-w-[650px] justify-center gap-4">
        <div class="bg-main-background border-borders flex cursor-help items-center gap-2 rounded-lg border-3 px-5 py-3 transition hover:scale-105 sm:px-6 sm:py-4" data-tippy-content="Exige que empresas com CIPA ofereçam Canal de Denúncias (com opção de anonimato) e promovam treinamentos contra assédio">
            <x-icon icon="regulation" class="text-primary-solid h-6 w-6" />
            <span class="font-text text-main-text text-left text-sm font-normal">Lei 14.457/22</span>
        </div>
        <div class="bg-main-background border-borders flex cursor-help items-center gap-2 rounded-lg border-3 px-5 py-3 transition hover:scale-105 sm:px-6 sm:py-4" data-tippy-content="O Canal de Denúncias combate a desigualdade salarial de gênero, permitindo identificar e corrigir disparidades de forma ágil e sigilosa.">
            <x-icon icon="regulation" class="text-primary-solid h-6 w-6" />
            <span class="font-text text-main-text text-left text-sm font-normal">Lei 14.611/23</span>
        </div>
    </div>

    {{-- Phrase --}}
    <div class="bg-main-background border-borders relative flex w-full max-w-[650px] cursor-help items-center gap-2 rounded-lg border-3 px-5 py-3 transition hover:scale-[102%] sm:px-6 sm:py-4">
        <span class="font-text text-main-text w-full text-center text-sm font-normal">Promova um ambiente ético, saudável e protegido, com base em dados e conformidade.</span>
    </div>

    <a href="" class="bg-primary-solid border-borders relative flex w-full max-w-[650px] items-center justify-center rounded-lg border-3 px-4 py-4 transition hover:scale-[102%] hover:brightness-95">
        <span class="text-main-background font-heading text-center text-sm font-semibold sm:text-base">Faça um teste gratuito</span>
    </a>
</section>
