<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.imports.head')
        <title>{{ env('APP_NAME') ?? 'Facilita Riscos Psicossociais' }}</title>
    </head>

    <body class="bg-main-background relative flex h-screen flex-row overflow-hidden">
        <livewire:components.sidebar-component />

        {{-- Main content --}}
        <main class="flex h-full flex-1 flex-col overflow-hidden">
            <livewire:components.private-header-component />

            <section class="flex flex-1 flex-col gap-6 overflow-auto p-4">
                {{ $slot }}
            </section>
        </main>

        {{-- LGPD Bar --}}
        {{-- <div data-role="lgpd-bar" class="fixed bottom-0 left-0 z-30 hidden w-full flex-col items-center justify-between gap-4 bg-gray-100 px-4 py-4 shadow-md md:flex-row md:px-8">
            <p class="text-center text-sm sm:text-base md:text-left">
                Ao utilizar este sistema, você declara estar ciente e de acordo com a nossa
                <a href="{{ route('privacy-policy') }}" class="text-blue-600 underline">Política de Privacidade</a>
                .
            </p>
            <x-action tag="button" variant="secondary">Confirmar</x-action>
        </div> --}}
    </body>
</html>
