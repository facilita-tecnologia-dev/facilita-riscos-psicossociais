<?php

namespace App\Livewire\CMS\Private\Psychosocial;

use App\Enums\BaseCollection as EnumBaseCollection;
use App\Enums\BaseCollectionType;
use App\Enums\CollectionType;
use App\Models\BaseCollection;
use App\Models\Campaign;
use App\Models\UserCollection;
use Livewire\Component;

class PsychosocialDashboardComponent extends Component
{
    public array $campaigns;
    public array $HSECampaigns;
    public array $PROARTCampaigns;

    public array $evaluatedUsers;
    public array $HSEEvaluatedUsers;
    public array $PROARTEvaluatedUsers;

    public function render()
    {
        return view('livewire.cms.private.psychosocial.psychosocial-dashboard-component');
    }

    public function mount()
    {
        $years = collect([now()->year, now()->year - 1, now()->year - 2]);

        // 0º Pegar todas as campanhas de psicossociais
        $basePsychosocialCollections = BaseCollection::where('type', BaseCollectionType::PSYCHOSOCIAL)->get();
        $psychosocialCampaigns = Campaign::where('type', CollectionType::BASE)
                                        ->whereIn('collection_id', $basePsychosocialCollections->pluck('id'))
                                        ->with('userCollections')
                                        ->get();

        // 1° pegar campanhas do HSE dividido por ano
        $HSEBaseCollection = $basePsychosocialCollections->where('key', EnumBaseCollection::HSE)?->first();
        $HSECampaigns = $psychosocialCampaigns->where('collection_id', $HSEBaseCollection->id)->groupBy(fn($campaign) => $campaign->start_date->format('Y'));
        $HSECampaignsByYear = $years->mapWithKeys(fn($year) => [$year => $HSECampaigns->get($year, collect())]);

        // 2° pegar campanhas do PROART dividido por ano
        $PROARTBaseCollection = $basePsychosocialCollections->where('key', EnumBaseCollection::PROART)?->first();
        $PROARTCampaigns = $psychosocialCampaigns->where('collection_id', $PROARTBaseCollection->id)->groupBy(fn($campaign) => $campaign->start_date->format('Y'));
        $PROARTCampaignsByYear = $years->mapWithKeys(fn($year) => [$year => $PROARTCampaigns->get($year, collect())]);

        // 3º pegar collections do HSE didivido por ano
        $HSECollectionsByYear = $HSECampaignsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->flatMap(fn($campaign) => $campaign->userCollections)]);
        
        // 4° pegar collections do PROART dividido por ano
        $PROARTCollectionsByYear = $PROARTCampaignsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->flatMap(fn($campaign) => $campaign->userCollections)]);
        
        // 5° somar todas as campanhas divididas por ano
        $psychocialCampaignsByYear = $HSECampaignsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->concat($PROARTCampaignsByYear->get($year))]);
        
        // 6° somar todas as collections divididas por ano
        $psychocialCollectionsByYear = $HSECollectionsByYear->mapWithKeys(fn($collections, $year) => [$year => $collections->concat($PROARTCollectionsByYear->get($year))]);

        
        $this->campaigns = [
            'total' => $psychocialCampaignsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->count()])->sum(),
            'lastYears' => $psychocialCampaignsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->count()]),
        ];

        $this->HSECampaigns = [
            'total' => $HSECampaignsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->count()])->sum(),
            'lastYears' => $HSECampaignsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->count()]),
        ];

        $this->PROARTCampaigns = [
            'total' => $PROARTCampaignsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->count()])->sum(),
            'lastYears' => $PROARTCampaignsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->count()]),
        ];

        $this->evaluatedUsers = [
            'total' => $psychocialCollectionsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->count()])->sum(),
            'lastYears' => $psychocialCollectionsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->count()]),
        ];

        $this->HSEEvaluatedUsers = [
            'total' => $HSECollectionsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->count()])->sum(),
            'lastYears' => $HSECollectionsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->count()]),
        ];

        $this->PROARTEvaluatedUsers = [
            'total' => $PROARTCollectionsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->count()])->sum(),
            'lastYears' => $PROARTCollectionsByYear->mapWithKeys(fn($campaigns, $year) => [$year => $campaigns->count()]),
        ];
    }
}
