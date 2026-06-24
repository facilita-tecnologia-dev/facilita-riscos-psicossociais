<?php

namespace App\Providers;

use App\Events\PaymentApproved;
use App\Events\PaymentFailed;
use App\Events\SubscriptionCanceled;
use App\Listeners\ActivateSubscription;
use App\Listeners\BlockCompanyAccess;
use App\Listeners\CancelSubscription;
use App\Models\Campaign;
use App\Models\Payment;
use App\Observers\PaymentObserver;
use App\Policies\CampaignPolicy;
use App\View\Composers\FiltersComposer;
use App\View\Composers\SidebarComposer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Password::defaults(function () {
            $rule = Password::min(8)->max(30);
    
            return $this->app->environment('production')
                ? $rule->mixedCase()->symbols()->uncompromised()
                : $rule;
        });

        Event::listen(
            PaymentApproved::class,
            ActivateSubscription::class,
        );

        Event::listen(
            PaymentFailed::class,
            BlockCompanyAccess::class,
        );

        Event::listen(
            SubscriptionCanceled::class,
            CancelSubscription::class,
        );

        Payment::observe(
            PaymentObserver::class
        );
    }
}
