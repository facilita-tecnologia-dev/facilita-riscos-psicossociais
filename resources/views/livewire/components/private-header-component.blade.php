<header class="bg-secondary-background border-borders flex w-full items-center justify-between border-b px-4 py-3 shadow-sm lg:px-6 lg:py-4">
    @if (session('auth:company')->logo)
        @php
            /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
            $s3 = Storage::disk('s3');
            $logo = $s3->temporaryUrl(session('auth:company')->logo, now()->addMinutes(5));
        @endphp
        <div class="flex items-center gap-4">
            <img src="{{ $logo }}" title="{{ session('auth:company')->name }}" class="h-8 object-scale-down transition hover:scale-105 md:h-10" alt="Logomarca" />
            <h1 class="text-secondary-text font-heading text-left text-xs sm:text-sm font-semibold" title="{{ session('auth:company')->name }}">{{ session('auth:company')->name }}</h1>
        </div>
    @else
        <h1 class="text-main-text font-heading text-left text-base font-semibold">{{ session('auth:company')->name }}</h1>
    @endif

    <div class="flex gap-3">
        @if(session('auth:guard') === 'user')
            <livewire:private.user.switch-company-component />
        @endif

        <div class="block md:hidden" wire:click="openSidebar">
            <x-actions.nav-item icon="hamburguer" />
        </div>

        <div wire:click="logout">
            <x-actions.nav-item icon="logout" tooltip="Sair do sistema" tooltipPosition="left" />
        </div>
    </div>
    
    @if(!request()->routeIs('campaign.answer'))
        <div data-role="lgpd-bar" class="fixed bottom-0 left-0 z-30 hidden w-full flex-col items-center justify-between gap-4 bg-secondary-background border border-borders px-4 py-4 shadow-md md:flex-row md:px-8">
            <p class="text-center text-sm sm:text-base md:text-left">
                Ao utilizar este sistema, você declara estar ciente e de acordo com a nossa <a href="{{ route('documentation.policy') }}" class="text-primary-solid underline">Política de Privacidade</a>.
            </p>
        
            <x-actions.button type="button" fitSize>
                <span class="font-heading text-main-background text-center text-sm font-semibold">Confirmar</span>
            </x-actions.button>
        </div>
    @endif
</header>
