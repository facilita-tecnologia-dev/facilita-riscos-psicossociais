<div class="contents">
    @if($open)
    <div class="fixed inset-0 z-30 flex items-center justify-center bg-black/60 px-4">
        <div class="bg-secondary-background border-borders flex flex-col gap-4 w-full max-w-xl rounded-lg border p-6 shadow-sm">
            <header class="flex w-full items-center justify-between">
                <h2 class="font-heading text-main-text text-left text-base sm:text-lg font-semibold">Acesso bloqueado</h2>
                <div class="cursor-pointer transition hover:scale-105" data-tippy-content="TODO">
                    <x-icon icon="circle-question-mark" class="text-secondary-text h-5 w-5 object-contain" />
                </div>
            </header>

            <div class="flex flex-col gap-2">
                <span class="font-text text-main-text text-sm font-normal sm:text-base">Seu acesso ao sistema foi bloqueado.</span>
                <span class="font-text text-main-text text-sm font-normal sm:text-base">Motivo: {{ $reason }}</span>
            </div>

            <div class="flex gap-3">
                <x-actions.button href="{{ route('home.company') }}">
                    <span class="text-main-background font-heading text-center text-sm font-semibold">Assinar</span>
                </x-actions.button>
                <x-actions.button href="{{ route('home.company') }}" class="!bg-danger">
                    <span class="text-main-background font-heading text-center text-sm font-semibold">Sair do sistema</span>
                </x-actions.button>
            </div>
        </div>
    </div>
    @endif
</div>


