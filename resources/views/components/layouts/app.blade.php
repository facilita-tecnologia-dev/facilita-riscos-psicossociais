<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.imports.head')

        <title>{{ env('APP_NAME') ?? 'Facilita Riscos Psicossociais' }}</title>
    </head>

    <body class="bg-cover background-gradient h-screen">

        {{ $slot }}

        {{-- LGPD Bar --}}
        <div data-role="lgpd-bar" class="hidden fixed z-30 bg-gray-100 bottom-0 left-0 w-full shadow-md py-4 px-4 md:px-8 items-center flex-col md:flex-row justify-between gap-4">
            <p class="text-sm sm:text-base text-center md:text-left">Ao utilizar este sistema, você declara estar ciente e de acordo com a nossa <a href="{{ route('privacy-policy') }}" class="underline text-blue-600">Política de Privacidade</a>.</p>
            <x-action tag="button" variant="secondary">Confirmar</x-action>
        </div>
    </body>
</html>