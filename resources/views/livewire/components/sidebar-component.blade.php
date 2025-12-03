<div class="contents" x-data="{ isSidebarMobileOpened: @entangle('isSidebarMobileOpened') }">
    {{-- Desktop --}}
    <aside class="bg-secondary-background border-borders hidden h-full w-fit flex-col items-center justify-center border-r p-3 px-3 py-0 shadow-sm md:flex">
        <nav class="flex flex-col gap-4">
            <x-new-components.actions.nav-item :href="session('auth:guard') === 'user' ? route('user.home') : route('company.home')" icon="home" activeRoute="*.home" tooltip="Início" />

            <div class="bg-borders h-0.5 w-8"></div>
            {{-- Divider --}}

            <x-new-components.actions.nav-item :href="route('psychosocial.dashboard')" icon="brain" activeRoute="psychosocial.*" tooltip="Riscos Psicossociais" />
            <x-new-components.actions.nav-item :href="route('organizational.dashboard')" icon="cloud" activeRoute="organizational.*" tooltip="Pesquisa de Clima Organizacional" />
            <x-new-components.actions.nav-item :href="route('campaign.index')" icon="calendar-clock" activeRoute="campaign.*" tooltip="Campanhas" />

            <div class="bg-borders h-0.5 w-8"></div>
            {{-- Divider --}}

            <x-new-components.actions.nav-item href="" icon="company" activeRoute="" tooltip="Empresa" />
            <x-new-components.actions.nav-item href="" icon="books" activeRoute="" tooltip="Documentação" />
        </nav>
    </aside>

    {{-- Mobile --}}
    <aside x-show="isSidebarMobileOpened" @click.outside="isSidebarMobileOpened = false" x-cloak x-transition:enter="transition duration-100 ease-out" x-transition:enter-start="-translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition duration-100 ease-in" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="-translate-x-full opacity-0" class="bg-secondary-background border-borders fixed top-0 left-0 z-20 flex h-full w-[300px] flex-col items-center justify-center border-r p-3 px-4 py-0 shadow-sm md:hidden">
        <nav class="flex w-full flex-col gap-4">
            <x-new-components.actions.mobile-nav-item :href="session('auth:guard') === 'user' ? route('user.home') : route('company.home')" icon="home" activeRoute="*.home" label="Início" />

            <div class="bg-borders h-0.5 w-8"></div>

            <x-new-components.actions.mobile-nav-item :href="route('psychosocial.dashboard')" icon="brain" activeRoute="psychosocial.*" label="Riscos Psicossociais" />
            <x-new-components.actions.mobile-nav-item :href="route('organizational.dashboard')" icon="cloud" activeRoute="organizational.*" label="Clima Organizacional" />
            <x-new-components.actions.mobile-nav-item :href="route('campaign.index')" icon="calendar-clock" activeRoute="campaign.*" label="Campanhas" />

            <div class="bg-borders h-0.5 w-8"></div>

            <x-new-components.actions.mobile-nav-item href="" icon="company" activeRoute="" label="Empresa" />
            <x-new-components.actions.mobile-nav-item href="" icon="books" activeRoute="" label="Documentação" />
        </nav>
    </aside>
</div>
