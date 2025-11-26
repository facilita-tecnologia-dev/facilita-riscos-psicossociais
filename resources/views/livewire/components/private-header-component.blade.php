<header class="bg-secondary-background border-borders flex w-full items-center justify-between border-b px-4 py-3 shadow-sm lg:px-6 lg:py-4">
    @if (session('auth:company')->logo)
        @php
            /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
            $s3 = Storage::disk('s3');
            $logo = $s3->temporaryUrl(session('auth:company')->logo, now()->addMinutes(5));
        @endphp

        <img src="{{ $logo }}" class="h-8 object-scale-down transition hover:scale-105 md:h-10" alt="Logomarca" />
    @else
        <h1 class="text-main-text font-heading text-left text-base font-semibold">{{ session('auth:company')->name }}</h1>
    @endif

    <div class="flex gap-3">
        <div class="block md:hidden" wire:click="openSidebar">
            <x-new-components.actions.nav-item icon="hamburguer" tooltip="Abrir barra lateral" tooltipPosition="left" />
        </div>

        <div wire:click="logout">
            <x-new-components.actions.nav-item icon="logout" tooltip="Sair do sistema" tooltipPosition="left" />
        </div>
    </div>
</header>
