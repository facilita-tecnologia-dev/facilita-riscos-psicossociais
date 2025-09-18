<?php

namespace App\Http\Controllers;

use App\Enums\BaseCollectionTypes;
use App\Http\Requests\CampaignStoreRequest;
use App\Http\Requests\CampaignUpdateRequest;
use App\Mail\CampaignEmail;
use App\Models\BaseCollection;
use App\Models\Collection;
use App\Models\Company;
use App\Models\Campaign;
use App\Models\CustomCollection;
use App\Models\User;
use App\Repositories\CampaignRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class CampaignController
{
    protected $campaignRepository;

    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    public function index()
    {
        Gate::authorize('campaign-index');

        $campaigns = session('auth:company')->campaigns()->paginate(15);

        return view('private.campaign.index', compact('campaigns'));
    }

    public function create()
    {
        Gate::authorize('campaign-create');

        $collections = BaseCollection::all()
            ->concat(session('auth:company')->customCollections)
            ->map(fn($c) => [
                'option' => $c->name . ($c instanceof BaseCollection ? ' (Padrão)' : ''), 
                'value' => ($c instanceof BaseCollection ? 'base_' : 'custom_') . $c->id
            ]);

        return view('private.campaign.create', compact('collections'));
    }

    public function store(CampaignStoreRequest $request)
    {
        Gate::authorize('campaign-create');
        
        $collectionID = explode('_', $request->validated('collection_id'))[1];
        
        if (session('auth:company')->hasCampaignThisYear($collectionID)) return back()->with('message', 'Sua empresa já cadastrou uma campanha de testes com o mesmo tipo nesse ano');

        $this->campaignRepository->store($request->validated());

        return to_route('campaign.index');
    }

    public function show(Campaign $campaign)
    {
        Gate::authorize('campaign-show');

        return view('private.campaign.show', compact('campaign'));
    }

    public function edit(Campaign $campaign)
    {
        Gate::authorize('campaign-edit');
        
        $collections = BaseCollection::all()
            ->concat(session('auth:company')->customCollections)
            ->map(fn($c) => [
                'option' => $c->name . ($c instanceof BaseCollection ? ' (Padrão)' : ''), 
                'value' => ($c instanceof BaseCollection ? 'base_' : 'custom_') . $c->id
            ]);

        return view('private.campaign.edit', compact('campaign', 'collections'));
    }

    public function update(CampaignUpdateRequest $request, Campaign $campaign)
    {
        Gate::authorize('campaign-edit');

        $collectionID = explode('_', $request->validated('collection_id'))[1];
        
        if (session('auth:company')->hasCampaignThisYear($collectionID) && $collectionID != $campaign->collection_id) return back()->with('message', 'Sua empresa já cadastrou uma campanha de testes com o mesmo tipo nesse ano');

        $this->campaignRepository->update($campaign, $request->validated());

        return to_route('campaign.index')->with('message', 'Campanha editada com sucesso.');
    }

    public function destroy(Campaign $campaign)
    {
        Gate::authorize('campaign-delete');
        $this->campaignRepository->destroy($campaign);

        return to_route('campaign.index')->with('message', 'Campanha excluída com sucesso.');
    }

    public function notify(Campaign $campaign)
    {
        $usersWithEmail = session('auth:company')->users->where('email');
        
        $usersWithEmail->each(function($user) use($campaign) {
            Mail::to($user->email)->queue(new CampaignEmail($user, session('auth:company'), $campaign));
        });

        return back()->with('message', 'Notificações disparadas com sucesso!');
    }

    public function close(Campaign $campaign)
    {
        $campaign->update(['end_date' => now()]);
        
        session('auth:company')->load('campaigns');
        
        return back()->with('message', 'Campanha encerrada com sucesso.');
    }
}
