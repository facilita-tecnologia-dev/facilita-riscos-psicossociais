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

class Company extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'companies';

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
        return BaseCollection::firstWhere('key', $this->psychosocial_collection_type);
    }

    public function organizationalCollection()
    {
        return BaseCollection::firstWhere('key', 'organizational-climate');
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
        return $this->metrics->where('metric.type', 'absences')->first()->value;
    }

    public function absenteeism(): float | null
    {
        return $this->metrics->where('metric.type', 'absenteeism')->first()->value;
    }

    public function accidents(): float | null
    {
        return $this->metrics->where('metric.type', 'accidents')->first()->value;
    }

    public function extraHours(): float | null
    {
        return $this->metrics->where('metric.type', 'extra-hours')->first()->value;
    }

    public function turnover(): float | null
    {
        return $this->metrics->where('metric.type', 'turnover')->first()->value;
    }
    
    public function getReports()
    {
        return ReportChannelService::hasReportChannel($this) ? 
                        ReportChannelService::reports($this) :
                        $this->reports->mapWithKeys(
                            fn($report) => [$report->type => $report->value]
                        );
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

    public function latestPsychosocialCampaign()
    {
        return $this->campaigns->where('collection_id', $this->psychosocialCollection()->id)->sortByDesc('start_date')->first();
    }

    public function latestOrganizationalCampaign()
    {
        return $this->campaigns->where('collection_id', $this->organizationalCollection()->id)->sortByDesc('start_date')->first();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token, 'company'));
    }
}
