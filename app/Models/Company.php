<?php

namespace App\Models;

use App\Enums\CampaignStatusTypes;
use App\Notifications\CustomResetPassword;
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
            ->withPivot('company_id');
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(UserFeedback::class);
    }

    public function metrics(): HasMany
    {
        return $this->hasMany(CompanyMetric::class, 'company_id');
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class, 'company_id');
    }

    public function actionPlan(): HasOne
    {
        return $this->hasOne(ActionPlan::class);
    }
    

    /* --- End Relations --- */

    public function hasCampaignThisYear(string $collectionID, string $status): bool
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
        return $this->campaigns->where('status', CampaignStatusTypes::IN_PROGRESS);
    }

    // public function hasCompletedBasicData() : bool
    // {
    //     return $this->users->count() && $this->logo && $this->metrics()->where('value')->count();
    // }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token, 'company'));
    }
}
