<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.imports.head')
        
        <title>{{ 'CMS - ' . (env('APP_NAME') ?? 'Facilita Riscos Psicossociais') }}</title>
    </head>

    <body class="bg-main-background relative flex h-screen">
        <aside class="h-full px-3 bg-secondary-background border-r border-borders shadow-sm flex flex-col justify-center">
            <nav class="space-y-4">
                <a href="" class="flex items-center justify-center w-8 h-8 rounded-sm transition {{ request()->routeIs('cms.psychosocial.*') ? 'bg-primary-solid hover:brightness-95 text-main-background' : 'bg-transparent hover:bg-borders text-secondary-text' }}" data-tippy-content="Facilita Riscos Psicossociais" data-tippy-placement="right">
                    <x-icon icon="psychosocial" class="w-6 h-6 object-scale-down text-inherit" />
                </a>
                <a href="" class="flex items-center justify-center w-8 h-8 rounded-sm transition {{ request()->routeIs('cms.report-channel.*') ? 'bg-report-channel-primary-solid hover:brightness-95 text-main-background' : 'bg-transparent hover:bg-borders text-secondary-text' }}" data-tippy-content="Facilita Canal de Denúncias" data-tippy-placement="right">
                    <x-icon icon="report-channel" class="w-6 h-6 object-scale-down text-inherit" />
                </a>
            </nav>
        </aside>
        
        {{ $slot }}
    </body>
</html>