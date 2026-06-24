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

        <livewire:subscription.subscription-modal-component />
    </body>
</html>
