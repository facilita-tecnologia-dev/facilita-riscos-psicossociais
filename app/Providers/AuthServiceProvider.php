<?php

namespace App\Providers;

use App\Enums\CampaignStatusTypes;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    // protected $policies = [
    //     User::class => UserPolicy::class,
    // ];

    public function register(): void {}

    public function boot(): void
    {
        // $this->registerPolicies();

        Gate::define('user-index', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('user_index');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('user-show', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('user_show') || $user->id === session('auth:user')->id;
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('user-create', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('user_create');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('user-edit', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('user_edit');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('user-delete', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('user_delete');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('answer-psychosocial-test', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('answer_tests') && session('auth:company')->hasCampaignThisYear(1, CampaignStatusTypes::IN_PROGRESS->value);
            }

            return false;
        });

        Gate::define('answer-organizational-test', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('answer_tests') && session('auth:company')->hasCampaignThisYear(1, CampaignStatusTypes::IN_PROGRESS->value);
            }

            return false;
        });

        Gate::define('feedbacks-index', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('feedbacks_index');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('company-show', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('company_show');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('company-edit', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('company_edit');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('metrics-edit', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('metrics_edit');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('psychosocial-dashboard-view', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('psychosocial_dashboard_view');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('organizational-dashboard-view', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('organizational_dashboard_view');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('demographics-dashboard-view', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('demographics_dashboard_view');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('campaign-index', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('campaign_index');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('campaign-show', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('campaign_show');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('campaign-create', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('campaign_create');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('campaign-edit', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('campaign_edit');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('campaign-delete', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('campaign_delete');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('user-permission-edit', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('user_permission_edit');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('user-department-scope-edit', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('user_department_scope_edit');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });
        
        Gate::define('custom-collections-index', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('collections_index');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('collections-edit', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('collections_edit');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('documentation-show', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('documentation_show');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('custom-collections-index', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('collections_index');
            }

            if (session('auth:guard') === 'company') {
                return true;
            }

            return false;
        });

        Gate::define('switch-companies', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');
                
                return $user->companies->count() > 1;
            }

            return false;
        });

        Gate::define('action-plan-edit', function (?Authenticatable $user) {
            if (session('auth:guard') === 'user') {
                /** @var User $user */
                $user = session('auth:user');

                return $user->hasPermission('action_plan_edit') && session('auth:company')->hasCampaignThisYear(1, CampaignStatusTypes::COMPLETED->value);
            }

            if (session('auth:guard') === 'company') {
                return session('auth:company')->hasCampaignThisYear(1, CampaignStatusTypes::COMPLETED->value);
            }

            return false;
        });
    }
}
