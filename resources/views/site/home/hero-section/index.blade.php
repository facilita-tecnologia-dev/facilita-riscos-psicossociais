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
    <livewire:site.hero-section-videos-component />

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
</section>
