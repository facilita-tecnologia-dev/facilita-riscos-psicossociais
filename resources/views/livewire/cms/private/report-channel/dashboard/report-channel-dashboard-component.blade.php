<section class="flex flex-col gap-6 p-4">
    <div class="space-y-3">
        <div class="flex gap-2 items-center">
            <x-icon icon="report-channel" class="w-6 h-6 object-scale-down text-report-channel-primary-solid" />
            <h1 class="text-xl md:text-2xl text-main-text font-semibold text-left">Facilita Canal de Denúncias</h1>
        </div>

        <x-structure.breadcrumbs 
            :links="[
                'Dashboard' => null,
            ]" 
        />
    </div>

    <div class="w-full flex flex-col sm:flex-row gap-2 sm:gap-4">
        <x-actions.button class="!bg-report-channel-primary-solid" href="{{ route('cms.report-channel.company.index') }}">
            <span class="text-main-background text-center text-sm font-semibold">Lista de empresas</span>
        </x-actions.button>
        <x-actions.button class="!bg-report-channel-primary-solid" href="{{ route('cms.report-channel.user.index') }}">
            <span class="text-main-background text-center text-sm font-semibold">Lista de usuários</span>
        </x-actions.button>
    </div>

    <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        {{-- Denúncias Realizadas --}}
        @include('cms.private.report-channel.dashboard.info-card.index', [
            'featured' => true,
            'title' => 'Denúncias Realizadas (Total)',
            'tooltip' => 'Esse card mostra a quantidade total de denúncias realizadas por ano utilizando o Facilita Canal de Denúncias.',
            'main' => ['label' => 'Total', 'value' => $reports['total']],
            'years' => $reports['lastYears'],
        ])

        @include('cms.private.report-channel.dashboard.info-card.index', [
            'title' => 'Denúncias Finalizadas (Total)',
            'tooltip' => 'Esse card mostra a quantidade total de denúncias finalizadas por ano utilizando o Facilita Canal de Denúncias.',
            'main' => ['label' => 'Total', 'value' => $completedReports['total']],
            'years' => $completedReports['lastYears'],
        ])

        @include('cms.private.report-channel.dashboard.info-card.index', [
            'title' => 'Denúncias Arquivadas (Total)',
            'tooltip' => 'Esse card mostra a quantidade total de denúncias arquivadas por ano utilizando o Facilita Canal de Denúncias.',
            'main' => ['label' => 'Total', 'value' => $archivedReports['total']],
            'years' => $archivedReports['lastYears'],
        ])
    </div>
</section>