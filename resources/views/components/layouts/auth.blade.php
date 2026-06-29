<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.imports.head')

        <title>Facilita Riscos Psicossociais</title>
    </head>

    <body class="bg-main-background relative flex h-screen items-center justify-center overflow-hidden">
        {{ $slot }}
        @stack('scripts')
    </body>
</html>
