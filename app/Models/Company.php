<?php

namespace App\Models;

use App\Enums\CampaignStatus;
use App\Notifications\ResetPassword;
use App\Services\ReportChannelService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\BaseCollection;
use App\Enums\BaseCollection as EnumBaseCollection;

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
        ];
    }

    /* --- Relations --- */

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'company_user')
            ->withPivot('role_id');
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

    public function proartIndicators(): HasMany
    {
        return $this->hasMany(CompanyPROARTIndicator::class, 'company_id');
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

    public function collections()
    {
        return collect([
            $this->psychosocialCollection(),
            $this->organizationalCollection()
        ]);
    }

    public function absences(): float | null
    {
        return $this->proartIndicators->where('metric.type', 'absences')->first()->value;
    }

    public function absenteeism(): float | null
    {
        return $this->proartIndicators->where('metric.type', 'absenteeism')->first()->value;
    }

    public function accidents(): float | null
    {
        return $this->proartIndicators->where('metric.type', 'accidents')->first()->value;
    }

    public function extraHours(): float | null
    {
        return $this->proartIndicators->where('metric.type', 'extra-hours')->first()->value;
    }

    public function turnover(): float | null
    {
        return $this->proartIndicators->where('metric.type', 'turnover')->first()->value;
    }
    
    public function getReports()
    {
        return ReportChannelService::hasReportChannel($this) ? 
                        ReportChannelService::reports($this) :
                        $this->reports->mapWithKeys(
                            fn($report) => [$report->type => $report->value]
                        );
    }

    public function usesHSE(): bool
    {
        return $this->psychosocial_collection_type === EnumBaseCollection::HSE->value;
    }

    public function hasCampaignThisYear(string $collectionID, ?string $status = null): bool
    {
        return $this->campaigns()
                    ->whereYear('start_date', now()->year)
                    ->where('collection_id', $collectionID)
                    ->when($status, function($q) use($status) {
                        $q->where('status', $status);
                    })
                    ->exists();
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
        return $this->campaigns->where('collection_id', $this->psychosocialCollection()?->id)->sortByDesc('start_date')->first();
    }

    public function latestOrganizationalCampaign(): Campaign | null
    {
        return $this->campaigns->where('collection_id', $this->organizationalCollection()?->id)->sortByDesc('start_date')->first();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token, 'company'));
    }
}
