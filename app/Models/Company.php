<?php

namespace App\Models;

use App\Enums\Campaign\CampaignStatus;
use App\Notifications\ResetPassword;
use App\Services\ReportChannel\ReportChannelService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\BaseCollection;
use App\Enums\Campaign\MetodologyType;
use App\Enums\Campaign\CollectionType;
use App\Enums\Campaign\CollectionCategory;
use App\Enums\Psychosocial\HSE\HSERiskMatrix;
use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Enums\Subscription\TrialExpiredReason;
use App\Policies\CompanyPolicy;

#[UsePolicy(CompanyPolicy::class)]
class Company extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'companies';

    protected BaseCollection $psychosocialCollection;
    protected BaseCollection $organizationalCollection;

    // Get the attributes that should be cast.
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'trial_started_at' => 'datetime',
            'trial_ends_at' => 'datetime',
            'trial_expired_at' => 'datetime',
            'subscription_status' => SubscriptionStatus::class,
            'access_status' => AccessStatus::class,
            'trial_expired_reason' => TrialExpiredReason::class,
            'has_cids' => 'boolean',
            'billing_managed_externally' => 'boolean',
            'risk_matrix' => HSERiskMatrix::class,
        ];
    }

    
    /* --- AUX --- */
    public function hasActiveTrial(): bool
    {
        if ($this->trial_started_at === null || $this->trial_ends_at === null) {return false;}
        if ($this->trial_expired_at !== null) {return false;}
        return now()->lessThanOrEqualTo($this->trial_ends_at);
    }

    public function hasActiveSubscription(): bool
    {
        return $this->subscription_status === SubscriptionStatus::ACTIVE;
    }

    public function canAccessSystem(): bool
    {
        if ($this->access_status === AccessStatus::BLOCKED) {return false;}
        if ($this->hasActiveSubscription()) {return true;}
        if ($this->hasActiveTrial()) {return true;}
        return false;
    }

    public function expireTrial(TrialExpiredReason $reason): void {
        $this->update([
            'trial_expired_at' => now(),
            'trial_expired_reason' => $reason,
            'access_status' => AccessStatus::BLOCKED,
        ]);
    }

    public function hasFullyConsumedTrial(): bool
    {
        return
            $this->hasReachedTrialEmployeeLimit()
            && $this->hasReachedTrialCampaignLimit()
            && $this->hasReachedTrialTestLimit()
            && $this->hasReachedTrialAbsenceLimit()
            && $this->hasReachedTrialPsychosocialReportLimit();
    }

    public function hasReachedTrialEmployeeLimit(): bool
    {
        return $this->allUsers()->count() >= 1;
    }

    public function hasReachedTrialCampaignLimit(): bool
    {
        return $this->campaigns()->count() >= 1;
    }

    public function hasReachedTrialTestLimit(): bool
    {
        return $this->userCollections()->count() >= 1;
    }

    public function hasReachedTrialAbsenceLimit(): bool
    {
        return $this->CIDAbsences()->count() >= 1;
    }

    public function hasReachedTrialPsychosocialReportLimit(): bool
    {
        return !!$this->actionPlan->file_path;
    }

    /* --- Relations --- */

    public function allUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'company_user')
                ->withPivot(['role_id','status',]);
    }

    public function activeUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'company_user')
                ->withPivot(['role_id', 'status'])
                ->wherePivot('status', 1);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'company_user')
            ->withPivot('user_id');
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(UserFeedback::class);
    }

    public function organizationalIndicators(): HasMany
    {
        return $this->hasMany(CompanyOrganizationalIndicator::class, 'company_id');
    }

    public function CIDAbsences(): HasMany
    {
        return $this->hasMany(CompanyAbsence::class);
    }

    public function reports():HasMany
    {
        return $this->hasMany(CompanyReport::class, 'company_id');
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class, 'company_id');
    }

    public function actionPlan(): HasOne
    {
        return $this->hasOne(ActionPlan::class);
    }

    public function customCollections(): HasMany
    {
        return $this->hasMany(CustomCollection::class);
    }

    public function organizationalReport(): HasOne
    {
        return $this->hasOne(OrganizationalReport::class);
    }

    public function userCollections(): HasMany
    {
        return $this->hasMany(UserCollection::class);
    }

    /* --- End Relations --- */

    public function psychosocialCollection()
    {
        if(!isset($this->psychosocialCollection)){
            $this->psychosocialCollection = BaseCollection::firstWhere('key', $this->psychosocial_collection_type);
        }
     
        return $this->psychosocialCollection;
    }

    public function organizationalCollection()
    {
        if(!isset($this->organizationalCollection)){
            $this->organizationalCollection = BaseCollection::firstWhere('key', 'organizational-climate');
        }
     
        return $this->organizationalCollection;
    }

    public function baseCollections()
    {
        return collect([
            $this->psychosocialCollection(),
            $this->organizationalCollection()
        ]);
    }

    public function absences(): float | null
    {
        return $this->organizationalIndicators->where('indicator.type', 'absences')->first()->value;
    }

    public function absenteeism(): float | null
    {
        return $this->organizationalIndicators->where('indicator.type', 'absenteeism')->first()->value;
    }

    public function accidents(): float | null
    {
        return $this->organizationalIndicators->where('indicator.type', 'accidents')->first()->value;
    }

    public function extraHours(): float | null
    {
        return $this->organizationalIndicators->where('indicator.type', 'extra-hours')->first()->value;
    }

    public function turnover(): float | null
    {
        return $this->organizationalIndicators->where('indicator.type', 'turnover')->first()->value;
    }
    
    public function getReports()
    {
        return ReportChannelService::hasReportChannel($this)
            ? ReportChannelService::reports($this)
            : $this->reports
                ->filter()
                ->mapWithKeys(fn($report) => [$report->type => $report->value]);
    }

    public function usesHSE(): bool
    {
        return $this->psychosocial_collection_type === MetodologyType::HSE->value;
    }

    public function hasOverlappingCampaign(string $collection_id, string $collection_type, string $start_date, string $end_date, ?int $ignore_campaign_id = null,): bool 
    {
        $collection = $collection_type === CollectionCategory::BASE->value
            ? BaseCollection::find($collection_id)
            : CustomCollection::find($collection_id);

        $campaigns = $this->campaigns()
            ->when($ignore_campaign_id, function ($query) use ($ignore_campaign_id) {
                $query->where('id', '!=', $ignore_campaign_id);
            })
            ->where(function ($query) use ($start_date, $end_date) {
                $query->where('start_date', '<=', $end_date)->where('end_date', '>=', $start_date);
            })
            ->get();

        return $campaigns
            ->filter(function ($campaign) use ($collection) {
                $campaignCollection = $campaign->collection();
                if (! $campaignCollection) return false;

                return $campaignCollection->type === $collection->type;
            })
            ->isNotEmpty();
    }

    public function activeCampaigns() : Collection
    {
        return $this->campaigns->where('status', CampaignStatus::IN_PROGRESS);
    }

    public function scheduledCampaigns() : Collection
    {
        return $this->campaigns->where('status', CampaignStatus::SCHEDULED);
    }

    public function latestPsychosocialCampaign(): Campaign | null
    {
        return $this->campaigns()
                    ->get()
                    ->filter(fn($campaign) => 
                        $campaign->collection()->type === CollectionType::PSYCHOSOCIAL 
                        && ($campaign->status === CampaignStatus::IN_PROGRESS || $campaign->status === CampaignStatus::COMPLETED)
                    )
                    ->sortByDesc('start_date')
                    ->first();
    }

    public function latestOrganizationalCampaign(): Campaign | null
    {
        return $this->campaigns()
                    ->get()
                    ->filter(fn($campaign) => 
                        $campaign->collection()->type === CollectionType::ORGANIZATIONAL 
                        && ($campaign->status === CampaignStatus::IN_PROGRESS || $campaign->status === CampaignStatus::COMPLETED)
                    )
                    ->sortByDesc('start_date')
                    ->first();
    }

    public function usesExternalBilling(): bool
    {
        return Company::find($this->id)->billing_managed_externally;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token, 'company'));
    }
}
