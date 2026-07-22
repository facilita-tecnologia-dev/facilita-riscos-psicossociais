<div class="contents" x-data="{ isMenuMobileOpen: false }">
    <header class="bg-main-background border-borders fixed top-8 left-1/2 z-3 flex h-[65px] w-[calc(100%-24px)] max-w-[1280px] -translate-x-1/2 items-center justify-between rounded-[64px] border px-6 shadow-sm md:h-[80px] md:px-8 xl:w-full">
        <div class="flex-1">
            <img src="{{ asset('assets/logo-facilita.webp') }}" class="h-10 object-scale-down transition hover:scale-105 md:h-12" alt="Logomarca" />
        </div>

        <nav class="hidden flex-1 flex-shrink-0 items-center justify-center gap-8 lg:flex">
            <x-site.nav-item label="Início" onclick="{{ request()->routeIs('site.home') ? 'scrollToY(event, \'hero-section\')' : null }}" :href="request()->routeIs('site.home') ? null : route('site.home')" />
            <x-site.nav-item label="Como funciona" onclick="{{ request()->routeIs('site.home') ? 'scrollToY(event, \'how-it-works\', 112)' : null }}" :href="request()->routeIs('site.home') ? null : route('site.home')" />
            <x-site.nav-item label="Nossa metodologia" onclick="{{ request()->routeIs('site.home') ? 'scrollToY(event, \'our-metodology\', 112)' : null }}" :href="request()->routeIs('site.home') ? null : route('site.home')" />
            <x-site.nav-item label="Assinar" :href="route('company.register')" />
        </nav>

        <div class="hidden flex-1 justify-end gap-3 lg:flex">
            <div>
                <div id="button-login">
                    <button class="px-4 h-10 bg-primary-solid cursor-pointer flex items-center justify-center rounded-full transition hover:brightness-95" data-tippy-content="Login">
                        <span class="text-main-background text-center text-sm font-semibold">Fazer login</span>
                    </button>
                </div>
                <div id="dropdown-login" class="hidden">
                    <nav class="space-y-2 px-2 py-3">
                        <a href="{{ route('company.login') }}" class="hover:bg-main-background/30 text-main-background font-heading block rounded-md px-3 py-1.5 text-left text-sm font-normal transition">Login como empresa</a>
                        <a href="{{ route('user.login') }}" class="hover:bg-main-background/30 text-main-background font-heading block rounded-md px-3 py-1.5 text-left text-sm font-normal transition">Login como funcionário</a>
                    </nav>
                </div>
            </div>
        </div>

        <button class="bg-primary-solid text-main-background flex h-9 w-9 cursor-pointer items-center justify-center rounded-full lg:hidden" aria-label="Abrir menu mobile" @click="isMenuMobileOpen = true">
            <x-icon icon="hamburguer" class="h-4 w-4 object-scale-down" />
        </button>
    </header>

    <div class="bg-main-text/20 fixed top-0 right-0 z-4 flex h-screen w-screen justify-end lg:hidden" x-show="isMenuMobileOpen" x-transition.opacity.duration.300ms>
        <aside class="bg-main-background flex h-screen w-full max-w-[280px] flex-col items-center gap-12 px-6 py-12" @click.outside="isMenuMobileOpen = false">
            <img src="{{ asset('assets/logo-facilita.webp') }}" class="h-10 object-scale-down transition hover:scale-105 md:h-12" alt="Logo Facilita Tecnologia" />

            <nav class="flex w-full flex-col items-start gap-4">
                <x-site.nav-item label="Início" onclick="{{ request()->routeIs('site.home') ? 'scrollToY(event, \'hero-section\')' : null }}" :href="request()->routeIs('site.home') ? null : route('site.home')" @click="isMenuMobileOpen = false" />
                <x-site.nav-item label="Como funciona" onclick="{{ request()->routeIs('site.home') ? 'scrollToY(event, \'how-it-works\', 90)' : null }}" :href="request()->routeIs('site.home') ? null : route('site.home')" @click="isMenuMobileOpen = false" />
                <x-site.nav-item label="Nossa metodologia" onclick="{{ request()->routeIs('site.home') ? 'scrollToY(event, \'our-metodology\', 90)' : null }}" :href="request()->routeIs('site.home') ? null : route('site.home')" @click="isMenuMobileOpen = false" />
                <x-site.nav-item label="Assinar" :href="route('company.register')" @click="isMenuMobileOpen = false" />
            </nav>

            <div class="w-full space-y-4">
                <div class="space-y-2">
                    <h3 class="text-main-text font-heading text-left text-sm font-semibold">Empresa</h3>
                    <a href="{{ route('company.login') }}" class="bg-secondary-background border-borders flex w-full items-center gap-2 rounded-sm border px-4 py-2 transition hover:brightness-95">
                        <x-icon icon="user-check" class="text-secondary-text h-5 w-5 object-scale-down" />
                        <span class="text-main-text font-heading text-left text-sm font-normal">Login</span>
                    </a>
                </div>

                <div class="space-y-2">
                    <h3 class="text-main-text font-heading text-left text-sm font-semibold">Funcionário</h3>

                    <a href="{{ route('user.login') }}" class="bg-secondary-background border-borders flex w-full items-center gap-2 rounded-sm border px-4 py-2 transition hover:brightness-95">
                        <x-icon icon="user-check" class="text-secondary-text h-5 w-5 object-scale-down" />
                        <span class="text-main-text font-heading text-left text-sm font-normal">Login</span>
                    </a>
                </div>
            </div>
        </aside>
    </div>
</div>
