<div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    {{-- Campanhas Realizadas --}}
    @include('cms.private.psychosocial.dashboard.info-card.index', [
        'featured' => true,
        'title' => 'Campanhas de Psicossociais (Total)',
        'tooltip' => 'Esse card mostra a quantidade de Campanhas de Riscos Psicossociais realizadas no sistema (HSE + PROART).',
        'main' => ['label' => 'Total', 'value' => $campaigns['total']],
        'years' => $campaigns['lastYears'],
    ])

    @include('cms.private.psychosocial.dashboard.info-card.index', [
        'title' => 'Campanhas de Psicossociais (HSE)',
        'tooltip' => 'Esse card mostra a quantidade de Campanhas de Riscos Psicossociais realizadas no sistema utilizando a metodologia HSE.',
        'main' => ['label' => 'Total', 'value' => $HSECampaigns['total']],
        'years' => $HSECampaigns['lastYears'],
    ])

    @include('cms.private.psychosocial.dashboard.info-card.index', [
        'title' => 'Campanhas de Psicossociais (PROART)',
        'tooltip' => 'Esse card mostra a quantidade de Campanhas de Riscos Psicossociais realizadas no sistema utilizando a metodologia PROART.',
        'main' => ['label' => 'Total', 'value' => $PROARTCampaigns['total']],
        'years' => $PROARTCampaigns['lastYears'],
    ])

    {{-- Usuarios Avaliados --}}
    @include('cms.private.psychosocial.dashboard.info-card.index', [
        'featured' => true,
        'title' => 'Usuários Avaliados (Total)',
        'tooltip' => 'Esse card mostra a quantidade de usuários cujos riscos psicossociais foram avaliados utilizando o sistema (HSE + PROART).',
        'main' => ['label' => 'Total', 'value' => $evaluatedUsers['total']],
        'years' => $evaluatedUsers['lastYears'],
    ])

    @include('cms.private.psychosocial.dashboard.info-card.index', [
        'title' => 'Usuários Avaliados  (HSE)',
        'tooltip' => 'Esse card mostra a quantidade de usuários cujos riscos psicossociais foram avaliados utilizando a metodologia HSE.',
        'main' => ['label' => 'Total', 'value' => $HSEEvaluatedUsers['total']],
        'years' => $HSEEvaluatedUsers['lastYears'],
    ])

    @include('cms.private.psychosocial.dashboard.info-card.index', [
        'title' => 'Usuários Avaliados  (PROART)',
        'tooltip' => 'Esse card mostra a quantidade de usuários cujos riscos psicossociais foram avaliados utilizando a metodologia PROART.',
        'main' => ['label' => 'Total', 'value' => $PROARTEvaluatedUsers['total']],
        'years' => $PROARTEvaluatedUsers['lastYears'],
    ])
</div>