<div class="relative flex w-full max-w-[650px] flex-col items-center gap-2">
    <div wire:ignore>
        <div class="swiper hero-section-swiper w-[320px] sm:w-[450px] md:w-[530px]">
            <div class="swiper-wrapper">
                <div
                    class="swiper-slide cursor-pointer h-full !w-fit"
                    data-video="{{ asset('assets/site/respondendo-testes.mp4') }}">
                    <button class="bg-main-background border-borders rounded-lg border-3 px-4 py-2 shadow-sm">
                        <span class="font-text text-main-text text-xs sm:text-sm">
                            Responder testes
                        </span>
                    </button>
                </div>

                <div class="swiper-slide cursor-pointer h-full !w-fit" data-video="{{ asset('assets/site/visualizar-resultados.mp4') }}">
                    <button class="bg-main-background border-borders rounded-lg border-3 px-4 py-2 shadow-sm">
                        <span class="font-text text-main-text text-xs sm:text-sm">
                            Visualizar resultados
                        </span>
                    </button>
                </div>

                <div class="swiper-slide cursor-pointer h-full !w-fit" data-video="{{ asset('assets/site/gerenciar-plano-de-acao.mp4') }}" >
                    <button class="bg-main-background border-borders rounded-lg border-3 px-4 py-2 shadow-sm">
                        <span class="font-text text-main-text text-xs sm:text-sm">
                            Gerenciar Plano de Ação
                        </span>
                    </button>
                </div>

                <div class="swiper-slide cursor-pointer h-full !w-fit" data-video="{{ asset('assets/site/gerenciar-funcionarios.mp4') }}" >
                    <button class="bg-main-background border-borders rounded-lg border-3 px-4 py-2 shadow-sm">
                        <span class="font-text text-main-text text-xs sm:text-sm">
                            Gerenciar funcionários
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <div class="flex h-[170px] gap-2 sm:h-[220px] md:h-[260px] mt-4">
            <button class="custom-prev bg-main-background border-borders hidden w-[45px] cursor-pointer items-center justify-center rounded-lg border-3 shadow-sm transition hover:scale-[102%] sm:flex">
                <x-icon icon="double-chevron-left" class="text-secondary-text h-6 w-6 object-scale-down" />
            </button>
            <div id="hero-video-click" class="border-borders w-[340px] flex-1 cursor-pointer overflow-hidden rounded-xl border-3 transition hover:scale-[102%] sm:w-[450px] md:w-[530px]">
                <video id="hero-section-video-canvas" src="{{ asset('assets/site/respondendo-testes.mp4') }}" class="h-full w-full object-cover" autoplay></video>
            </div>
            <button class="custom-next bg-main-background border-borders hidden w-[45px] cursor-pointer items-center justify-center rounded-lg border-3 shadow-sm transition hover:scale-[102%] sm:flex">
                <x-icon icon="double-chevron-right" class="text-secondary-text h-6 w-6 object-scale-down" />
            </button>
        </div>
    </div>

    @if($showModal)
        <div class="fixed inset-0 bg-black/60 flex items-center justify-center z-30 px-4">
            <div wire:click.outside="closeModal()" class="bg-secondary-background border-borders flex flex-col gap-6 rounded-lg border p-6 shadow-sm w-full max-w-2xl">
                @if ($videoUrl)
                    <video src="{{ $videoUrl }}" controls autoplay class="w-full object-contain rounded-sm"></video>
                @else
                    <x-icon icon="loading" class="text-main-background h-4 w-4 animate-spin object-scale-down" />
                @endif
            </div>
        </div>
    @endif
</div>
