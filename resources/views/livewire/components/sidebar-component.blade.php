<div class="contents" x-data="{ isSidebarMobileOpened: @entangle('isSidebarMobileOpened') }">
    @php
        $canAccessOrganizational = session('auth:company')->can_access_organizational;

        $hasPsychosocial = Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('psychosocialDashboard', [\App\Models\User::class]);
        $hasOrganizational = Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('organizationalDashboard', [\App\Models\User::class]);
        $hasCampaign = Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('viewAny', [\App\Models\Campaign::class]);

        $hasFirstSection = $hasPsychosocial || $hasOrganizational || $hasCampaign;

        $hasProfile = session('auth:guard') === 'user';
        $hasCompany = Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('show', [\App\Models\Company::class, session('auth:company')]);
        $hasDocumentation = Gate::forUser(App\Services\Auth\AuthenticationService::user())->check('documentation', [\App\Models\User::class]);

        $hasSecondSection = $hasProfile || $hasCompany || $hasDocumentation;
    @endphp

    {{-- Desktop --}}
    <aside class="bg-secondary-background border-borders hidden h-full w-fit flex-col items-center justify-center border-r p-3 px-3 py-0 shadow-sm md:flex">
        <nav class="flex flex-col gap-4">
            <x-actions.nav-item :href="session('auth:guard') === 'user' ? route('home.user') : route('home.company')" icon="home" activeRoute="home.*" tooltip="Início" />
            
            @if($hasFirstSection)
                <div class="bg-borders h-0.5 w-8"></div>
            @endif

            @if($hasPsychosocial)
                <x-actions.nav-item :href="route('psychosocial.dashboard', session('auth:company')->latestPsychosocialCampaign())" icon="brain" activeRoute="psychosocial.*" tooltip="Riscos Psicossociais" />
            @endif
            
            @if($canAccessOrganizational && $hasOrganizational)
                <x-actions.nav-item :href="route('organizational.dashboard', session('auth:company')->latestOrganizationalCampaign())" icon="cloud" activeRoute="organizational.*" tooltip="Pesquisa de Clima Organizacional" />
            @endif

            @if($hasCampaign)
                <x-actions.nav-item :href="route('campaign.index')" icon="calendar-clock" activeRoute="campaign.*" tooltip="Campanhas" />
            @endif

            @if($hasSecondSection)
                <div class="bg-borders h-0.5 w-8"></div>
            @endif

            @if($hasProfile)
                <x-actions.nav-item :href="route('user.show', session('auth:user'))" icon="profile" activeRoute="['user.show']" tooltip="Meu perfil" />
            @endif

            @if($hasCompany)
                <x-actions.nav-item :href="route('company.show', session('auth:company'))" icon="company" :activeRoute="['company.*', 'user.*']" tooltip="Empresa" />
            @endif

            @if($hasDocumentation)
                <x-actions.nav-item :href="route('documentation.index')" icon="books" activeRoute="documentation.*" tooltip="Documentação" />
            @endif
        </nav>
    </aside>

    {{-- Mobile --}}
    <aside x-show="isSidebarMobileOpened" @click.outside="isSidebarMobileOpened = false" x-cloak x-transition:enter="transition duration-100 ease-out" x-transition:enter-start="-translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition duration-100 ease-in" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="-translate-x-full opacity-0" class="bg-secondary-background border-borders fixed top-0 left-0 z-20 flex h-full w-[300px] flex-col items-center justify-center border-r p-3 px-4 py-0 shadow-sm md:hidden">
        <nav class="flex w-full flex-col gap-4">
            <x-actions.mobile-nav-item :href="session('auth:guard') === 'user' ? route('home.user') : route('home.company')" icon="home" activeRoute="home.*" label="Início" />

            @if($hasFirstSection)
                <div class="bg-borders h-0.5 w-8"></div>
            @endif
            
            @if($hasPsychosocial)
                <x-actions.mobile-nav-item :href="route('psychosocial.dashboard', session('auth:company')->latestPsychosocialCampaign())" icon="brain" activeRoute="psychosocial.*" label="Riscos Psicossociais" />
            @endif

            @if($canAccessOrganizational && $hasOrganizational)
                <x-actions.mobile-nav-item :href="route('organizational.dashboard', session('auth:company')->latestOrganizationalCampaign())" icon="cloud" activeRoute="organizational.*" label="Clima Organizacional" />
            @endif

            @if($hasCampaign)
                <x-actions.mobile-nav-item :href="route('campaign.index')" icon="calendar-clock" activeRoute="campaign.*" label="Campanhas" />
            @endif

            @if($hasSecondSection)
                <div class="bg-borders h-0.5 w-8"></div>
            @endif

            @if($hasProfile)
                <x-actions.mobile-nav-item :href="route('user.show', session('auth:user'))" icon="profile" activeRoute="['user.show']" label="Meu perfil" />
            @endif

            @if($hasCompany)
                <x-actions.mobile-nav-item :href="route('company.show', session('auth:company'))" icon="company" activeRoute="['company.*', 'user.*']"  label="Empresa" />
            @endif

            @if($hasDocumentation)
                <x-actions.mobile-nav-item :href="route('documentation.index')" icon="books" activeRoute="documentation.*" label="Documentação" />
            @endif
        </nav>
    </aside>
</div>
