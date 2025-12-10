<?php

namespace App\Providers;

use App\Models\Campaign;
use App\Policies\CampaignPolicy;
use App\View\Composers\FiltersComposer;
use App\View\Composers\SidebarComposer;
use Illuminate\Database\Eloquent\Model;
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
    }
}
