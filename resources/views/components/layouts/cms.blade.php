<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.imports.head')
        
        <title>{{ 'CMS - ' . (env('APP_NAME') ?? 'Facilita Riscos Psicossociais') }}</title>
    </head>

    <body class="bg-main-background relative flex h-screen">
        <aside class="h-full px-3 bg-secondary-background border-r border-borders shadow-sm flex flex-col justify-center">
            <nav class="space-y-4">
                <x-new-components.actions.nav-item icon="psychosocial" activeRoute="cms.psychosocial.*" tooltip="Facilita Riscos Psicossociais" />
                <x-new-components.actions.nav-item icon="report-channel" activeRoute="cms.report-channel.*" tooltip="Facilita Canal de Denúncias" />
            </nav>
        </aside>
        
        <main class="flex-1 h-full">
            <header class="w-full bg-secondary-background px-6 py-4 border-b border-borders shadow-sm flex justify-between items-center">
                <span class="text-lg text-main-text text-left font-semibold">Facilita Tecnologia - CMS</span>
                <x-new-components.actions.nav-item icon="logout" tooltip="Sair" tooltipPosition="left" />
            </header>

            {{ $slot }}
        </main>
    </body>
</html>