<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.imports.head')
        
        <title>{{ 'CMS - ' . (env('APP_NAME') ?? 'Facilita Riscos Psicossociais') }}</title>
    </head>

    <body class="bg-main-background relative flex flex-col-reverse lg:flex-row h-screen overflow-hidden">
        <aside class="w-full lg:w-fit lg:h-full bg-secondary-background border-t lg:border-t-0 lg:border-r border-borders shadow-sm flex justify-around lg:justify-center items-center lg:flex-col p-3 lg:px-3 lg:py-0">
            <nav class="flex flex-row lg:flex-col gap-4">
                <x-new-components.actions.nav-item href="{{ route('cms.psychosocial.dashboard') }}" icon="psychosocial" activeRoute="cms.psychosocial.*" tooltip="Facilita Riscos Psicossociais" />
                <x-new-components.actions.nav-item icon="report-channel" activeRoute="cms.report-channel.*" tooltip="Facilita Canal de Denúncias" />
            </nav>
        </aside>
        
        {{-- Main content --}}
        <main class="flex-1 h-full flex flex-col overflow-hidden">
            <header class="w-full bg-secondary-background px-4 py-3 lg:px-6 lg:py-4 border-b border-borders shadow-sm flex justify-between items-center">
                <span class="text-md lg:text-lg text-main-text font-semibold">Facilita Tecnologia - CMS</span>
                <x-new-components.actions.nav-item icon="logout" tooltip="Sair" tooltipPosition="left" />
            </header>

            <section class="flex-1 overflow-auto">
                {{ $slot }}
            </section>
        </main>
    </body>
</html>