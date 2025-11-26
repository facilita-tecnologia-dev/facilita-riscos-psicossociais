<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.imports.head')
        <title>{{ env('APP_NAME') ?? 'Facilita Riscos Psicossociais' }}</title>
    </head>

    <body class="bg-main-background relative flex h-screen flex-row overflow-hidden">
        {{-- Desktop --}}
        <aside class="bg-secondary-background border-borders hidden h-full w-fit flex-col items-center justify-center border-r p-3 px-3 py-0 shadow-sm md:flex">
            <nav class="flex flex-col gap-4">
                <x-new-components.actions.nav-item :href="session('auth:guard') === 'user' ? route('user.home') : route('company.home')" icon="home" activeRoute="welcome.*" tooltip="Início" />

                <div class="bg-borders h-0.5 w-8"></div>
                {{-- Divider --}}

                <x-new-components.actions.nav-item href="" icon="brain" activeRoute="" tooltip="Riscos Psicossociais" />
                <x-new-components.actions.nav-item href="" icon="cloud" activeRoute="" tooltip="Pesquisa de Clima Organizacional" />
                <x-new-components.actions.nav-item href="" icon="calendar-clock" activeRoute="" tooltip="Campanhas" />

                <div class="bg-borders h-0.5 w-8"></div>
                {{-- Divider --}}

                <x-new-components.actions.nav-item href="" icon="company" activeRoute="" tooltip="Empresa" />
                <x-new-components.actions.nav-item href="" icon="books" activeRoute="" tooltip="Documentação" />
            </nav>
        </aside>

        {{-- Mobile --}}
        {{--
            <aside class="bg-secondary-background border-borders fixed top-0 left-0 z-20 flex h-full w-[300px] flex-col items-center justify-center border-r p-3 px-4 py-0 shadow-sm md:hidden">
            <nav class="flex w-full flex-col gap-4">
            <x-new-components.actions.mobile-nav-item href="" icon="home" activeRoute="welcome.*" label="Início" />
            
            <div class="bg-borders h-0.5 w-8"></div>
            
            <x-new-components.actions.mobile-nav-item href="" icon="brain" activeRoute="" label="Riscos Psicossociais" />
            <x-new-components.actions.mobile-nav-item href="" icon="cloud" activeRoute="" label="Clima Organizacional" />
            <x-new-components.actions.mobile-nav-item href="" icon="calendar-clock" activeRoute="" label="Campanhas" />
            
            <div class="bg-borders h-0.5 w-8"></div>
            
            <x-new-components.actions.mobile-nav-item href="" icon="company" activeRoute="" label="Empresa" />
            <x-new-components.actions.mobile-nav-item href="" icon="books" activeRoute="" label="Documentação" />
            </nav>
            </aside>
        --}}

        {{-- Main content --}}
        <main class="flex h-full flex-1 flex-col overflow-hidden">
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
                    <div class="block md:hidden">
                        <x-new-components.actions.nav-item icon="hamburguer" tooltip="Abrir barra lateral" tooltipPosition="left" />
                    </div>

                    <x-new-components.actions.nav-item href="{{ route('logout') }}" icon="logout" tooltip="Sair do sistema" tooltipPosition="left" />
                </div>
            </header>

            <section class="flex flex-1 flex-col gap-6 overflow-auto p-4">
                {{ $slot }}
            </section>
        </main>

        {{-- LGPD Bar --}}
        <div data-role="lgpd-bar" class="fixed bottom-0 left-0 z-30 hidden w-full flex-col items-center justify-between gap-4 bg-gray-100 px-4 py-4 shadow-md md:flex-row md:px-8">
            <p class="text-center text-sm sm:text-base md:text-left">
                Ao utilizar este sistema, você declara estar ciente e de acordo com a nossa
                <a href="{{ route('privacy-policy') }}" class="text-blue-600 underline">Política de Privacidade</a>
                .
            </p>
            <x-action tag="button" variant="secondary">Confirmar</x-action>
        </div>
    </body>
</html>
