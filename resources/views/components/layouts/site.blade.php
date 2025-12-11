<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.imports.head')

        <title>{{ env('APP_NAME') ?? 'Facilita Riscos Psicossociais' }}</title>
    </head>

    <body class="bg-main-background relative">
        <livewire:components.site-header-component />
        
        {{ $slot }}

        <x-site.site-footer />
    </body>
</html>
