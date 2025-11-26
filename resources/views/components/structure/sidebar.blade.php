<div data-role="sidebar-mobile-button" class="fixed top-2 left-4 z-20 flex h-10 w-10 cursor-pointer items-center justify-center rounded-full bg-gray-100 shadow-md md:left-8">
    <i class="fa-solid fa-bars text-gray-800"></i>
</div>

<div id="sidebar" class="absolute top-0 -left-full z-40 flex h-screen w-[280px] flex-col overflow-auto bg-gray-100 pt-8 pb-12 shadow-lg transition-all duration-200">
    <header class="flex w-full items-center justify-center px-8 py-2">
        @if (session('auth:company')->logo)
            <img src="{{ asset(session('auth:company')->logo) }}" alt="" class="max-h-12 w-full object-contain" />
        @else
            <h2 class="text-left text-lg font-semibold">{{ session('auth:company')->name }}</h2>
        @endif
    </header>

    <div class="flex flex-1 flex-col gap-6 px-4 py-8">
        <x-sidebar.menu title="Home">
            <x-sidebar.item href="{{ session('auth:guard') === 'user' ? route('user.home') : route('company.home') }}" class="">
                <div class="flex w-5 items-center justify-center">
                    <i class="fa-solid fa-house"></i>
                </div>
                Home
            </x-sidebar.item>
        </x-sidebar.menu>

        @canany(['psychosocial-dashboard-view', 'organizational-dashboard-view', 'feedbacks-index', 'metrics-edit', 'demographics-dashboard-view'])
            <x-sidebar.menu title="Dados">
                @can('psychosocial-dashboard-view')
                    <div @if(!session('auth:company')->latestPsychosocialCampaign() || session('auth:company')->latestPsychosocialCampaign()?->userCollections->isEmpty()) data-tippy-content="Você ainda não realizou testes de Riscos Psicossociais" @endif>
                        <x-sidebar.item href="{{ route('dashboard.psychosocial') }}" class="{{ request()->routeIs('dashboard.psychosocial') ? 'bg-gray-200' : ''}} {{ !session('auth:company')->latestPsychosocialCampaign() || session('auth:company')->latestPsychosocialCampaign()?->userCollections->isEmpty() ? 'pointer-events-none opacity-50' : '' }}">
                            <div class="flex w-5 items-center justify-center">
                                <i class="fa-solid fa-brain"></i>
                            </div>
                            Riscos Psicossociais
                        </x-sidebar.item>
                    </div>
                @endcan

                {{--
                    @can('organizational-dashboard-view')
                    <div @if(!session('auth:company')->latestOrganizationalCampaign() || session('auth:company')->latestOrganizationalCampaign()?->userCollections->isEmpty()) data-tippy-content="Você ainda não realizou testes de Pesquisa de Clima" @endif>
                    <x-sidebar.item href="{{ route('dashboard.organizational-climate') }}" class="{{ request()->routeIs('dashboard.organizational-climate') ? 'bg-gray-200' : ''}} {{ !session('auth:company')->latestOrganizationalCampaign() || session('auth:company')->latestOrganizationalCampaign()?->userCollections->isEmpty() ? 'pointer-events-none opacity-50' : '' }}">
                    <div class="w-5 flex justify-center items-center">
                    <i class="fa-solid fa-cloud"></i>
                    </div>
                    Clima Organizacional
                    </x-sidebar.item>
                    </div>
                    @endcan
                    
                    @can('feedbacks-index')
                    <div @if(!session('auth:company')->latestOrganizationalCampaign() || session('auth:company')->latestOrganizationalCampaign()?->userCollections->isEmpty()) data-tippy-content="Você ainda não realizou campanhas de Pesquisa de Clima" @endif>
                    <x-sidebar.item href="{{ route('feedback.index') }}" class="{{ request()->routeIs('feedback.index') ? 'bg-gray-200' : ''}} {{ !session('auth:company')->latestOrganizationalCampaign() || session('auth:company')->latestOrganizationalCampaign()?->userCollections->isEmpty() ? 'pointer-events-none opacity-50' : '' }}">
                    <div class="w-5 flex justify-center items-center">
                    <i class="fa-solid fa-comments"></i>
                    </div>
                    Lista de comentários
                    </x-sidebar.item>
                    </div>
                    @endcan
                --}}

                @can('metrics-edit')
                    @if (session('auth:company')->usesHSE())
                        <div @if(session('auth:company')->users->isEmpty()) data-tippy-content="Você deve cadastrar colaboradores antes de editar os Indicadores Epidemiológicos" @endif>
                            <x-sidebar.item href="{{ route('company-absence.index') }}" class="{{ request()->routeIs('company-absence.index') ? 'bg-gray-200' : ''}} {{ session('auth:company')->users->isEmpty()  ? 'pointer-events-none opacity-50' : '' }}">
                                <div class="flex w-5 items-center justify-center">
                                    <i class="fa-solid fa-percent"></i>
                                </div>
                                Indicadores Epidemiológicos
                            </x-sidebar.item>
                        </div>
                    @else
                        <div @if(session('auth:company')->users->isEmpty()) data-tippy-content="Você deve cadastrar colaboradores antes de editar os dados de desempenho" @endif>
                            <x-sidebar.item href="{{ route('company-metrics.edit') }}" class="{{ request()->routeIs('company-metrics.edit') ? 'bg-gray-200' : ''}} {{ session('auth:company')->users->isEmpty()  ? 'pointer-events-none opacity-50' : '' }}">
                                <div class="flex w-5 items-center justify-center">
                                    <i class="fa-solid fa-percent"></i>
                                </div>
                                Dados de Desempenho Organizacional
                            </x-sidebar.item>
                        </div>
                    @endif
                @endcan

                @can('demographics-dashboard-view')
                    <div @if(session('auth:company')->users->isEmpty()) data-tippy-content="Você deve cadastrar colaboradores antes de visualizar dados demográficos" @endif>
                        <x-sidebar.item href="{{ route('dashboard.demographics') }}" class="{{ request()->routeIs('dashboard.demographics') ? 'bg-gray-200' : ''}} {{ session('auth:company')->users->isEmpty()  ? 'pointer-events-none opacity-50' : '' }}">
                            <div class="flex w-5 items-center justify-center">
                                <i class="fa-solid fa-chart-pie"></i>
                            </div>
                            Índices Demográficos
                        </x-sidebar.item>
                    </div>
                @endcan
            </x-sidebar.menu>
        @endcanany

        @canany(['campaign-index', 'answer-psychosocial-test', 'answer-organizational-test', 'custom-collections-index'])
            <x-sidebar.menu title="Testes">
                @can('campaign-index')
                    <x-sidebar.item href="{{ route('campaign.index') }}" class="{{ request()->routeIs('campaign.index') ? 'bg-gray-200' : ''}}">
                        <div class="flex w-5 items-center justify-center">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        Campanhas
                    </x-sidebar.item>
                @endcan

                {{--
                    @can('custom-collections-index')
                    <x-sidebar.item href="{{ route('custom-collections.index') }}" class="{{ request()->routeIs('custom-collections.index') ? 'bg-gray-200' : ''}}">
                    <div class="w-5 flex justify-center items-center">
                    <i class="fa-solid fa-book"></i>
                    </div>
                    Formulários de Pesquisa
                    </x-sidebar.item>
                    @endcan
                --}}
                @can('answer-psychosocial-test')
                    @if ($hasActivePsychosocialCampaign)
                        <x-sidebar.item href="{{ route('test', session('auth:company')->latestPsychosocialCampaign()) }}" class="{{ $hasAnsweredPsychosocial  ? 'pointer-events-none opacity-50' : '' }}">
                            <div class="flex w-5 items-center justify-center">
                                <i class="fa-solid fa-question"></i>
                            </div>
                            Riscos Psicossociais
                        </x-sidebar.item>
                    @endif
                @endcan

                {{--
                    @can('answer-organizational-test')
                    @if($hasActiveOrganizationalCampaign)
                    <x-sidebar.item href="{{ route('test', session('auth:company')->latestOrganizationalCampaign()) }}" class="{{ $hasAnsweredOrganizational  ? 'pointer-events-none opacity-50' : '' }}">
                    <div class="w-5 flex justify-center items-center">
                    <i class="fa-solid fa-question"></i>
                    </div>
                    Clima Organizacional
                    </x-sidebar.item>
                    @endif
                    @endcan
                --}}
            </x-sidebar.menu>
        @endcanany

        @canany(['company-show', 'user-index'])
            <x-sidebar.menu title="Empresa">
                @can('company-show')
                    <x-sidebar.item href="{{ route('company.show', session('auth:company')) }}" class="{{ request()->routeIs('company.show') ? 'bg-gray-200' : ''}}">
                        <div class="flex w-5 items-center justify-center">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        Empresa
                    </x-sidebar.item>
                @endcan

                @can('user-index')
                    <x-sidebar.item href="{{ route('user.index') }}" class="{{ request()->routeIs('user.index') ? 'bg-gray-200' : ''}}">
                        <div class="flex w-5 items-center justify-center">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        Colaboradores
                    </x-sidebar.item>
                @endcan

                @can('control-actions-edit')
                    <x-sidebar.item href="{{ route('control-actions.update') }}" class="{{ request()->routeIs('action-plan.show') ? 'bg-gray-200' : ''}}">
                        <div class="flex w-5 items-center justify-center">
                            <i class="fa-solid fa-list-ul"></i>
                        </div>
                        Medidas de controle
                    </x-sidebar.item>
                @endcan
            </x-sidebar.menu>
        @endcanany

        @can('documentation-show')
            <x-sidebar.menu title="Documentação">
                <x-sidebar.item href="{{ asset('files/criterios-para-avaliação-de-riscos-psicossociais.pdf') }}" target="_blank">
                    <div class="flex w-5 items-center justify-center">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    Classificação de Riscos
                </x-sidebar.item>
                <x-sidebar.item href="{{ route('privacy-policy') }}">
                    <div class="flex w-5 items-center justify-center">
                        <i class="fa-solid fa-file-shield"></i>
                    </div>
                    LGPD
                </x-sidebar.item>
            </x-sidebar.menu>
        @endcan

        <x-sidebar.menu title="Logout">
            <x-sidebar.item href="{{ route('logout') }}" onclick="return confirm('Você deseja mesmo sair?')">
                <div class="flex w-5 items-center justify-center">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
                Logout
            </x-sidebar.item>
        </x-sidebar.menu>

        @can('switch-companies')
            <x-sidebar.menu title="Login em outra empresa">
                <x-sidebar.switch-company :companies="$companies" />
            </x-sidebar.menu>
        @endcan
    </div>

    @if (session('auth:guard') === 'user')
        <footer class="flex flex-col gap-2 px-4 py-2">
            <a href="{{ route('user.show', session('auth:user')) }}" class="flex items-center justify-start gap-2 rounded-md px-2 py-1.5 transition hover:bg-gray-200">
                <div class="flex w-5 items-center justify-center">
                    <i class="fa-solid fa-user"></i>
                </div>
                <span class="flex-1 truncate">{{ Auth::guard('user')->user()->name }}</span>
            </a>
        </footer>
    @endif
</div>
