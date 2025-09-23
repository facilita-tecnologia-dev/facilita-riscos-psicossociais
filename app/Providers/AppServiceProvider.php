<?php

namespace App\Providers;

use App\View\Composers\FiltersComposer;
use App\View\Composers\SidebarComposer;
use Illuminate\Database\Eloquent\Model;
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
        
        View::composer('components.structure.sidebar', SidebarComposer::class);
        View::composer('components.filter-actions', FiltersComposer::class);

        Password::defaults(function () {
            $rule = Password::min(8)->max(30);
    
            return $this->app->environment('production')
                ? $rule->mixedCase()->symbols()->uncompromised()
                : $rule;
        });
    }
}
