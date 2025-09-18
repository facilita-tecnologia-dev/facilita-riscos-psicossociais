<?php

use App\Http\Controllers\ActionPlanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CustomCollectionController;
use App\Http\Controllers\CustomControlActionController;
use App\Http\Controllers\CustomQuestionController;
use App\Http\Controllers\CustomTestController;
use App\Http\Controllers\Private\CompanyController;
use App\Http\Controllers\Private\CompanyMetricsController;
use App\Http\Controllers\Private\Dashboard\Demographics\DemographicsMainController;
use App\Http\Controllers\Private\Dashboard\Organizational\OrganizationalAnswersController;
use App\Http\Controllers\Private\Dashboard\Organizational\OrganizationalMainController;
use App\Http\Controllers\Private\Dashboard\Psychosocial\PsychosocialMainController;
use App\Http\Controllers\Private\Dashboard\Psychosocial\PsychosocialResultsByDepartmentController;
use App\Http\Controllers\Private\Dashboard\Psychosocial\PsychosocialResultsListController;
use App\Http\Controllers\Private\Dashboard\Psychosocial\PsychosocialRisksController;
use App\Http\Controllers\Private\TestsController;
use App\Http\Controllers\Private\UserController;
use App\Http\Controllers\Private\UserFeedbackController;
use App\Http\Controllers\Private\WelcomeController;
use App\Http\Controllers\ResetUserPasswordController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;
use Illuminate\Support\Facades\Route;

Route::view('/', 'site.home.index')->name('site.home');
Route::view('/privacy-policy', 'site.privacy-policy.index')->name('site.privacy-policy');
Route::view('/terms-of-use', 'site.terms-of-use.index')->name('site.terms-of-use');

Route::middleware(GuestMiddleware::class)->group(function() {
    Route::prefix('register')->group(function(){
        Route::get('/empresa', [RegisterController::class, 'showRegister'])->name('company.register');
        Route::post('/empresa', [RegisterController::class, 'register']);
    });

    Route::prefix('login')->group(function(){
        Route::view('/company', 'auth.login.company.index')->name('company.login');
        Route::post('/company', [LoginController::class, 'authenticateCompany']);

        Route::view('/user', 'auth.login.user.index')->name('user.login');
        Route::post('/user', [LoginController::class, 'authenticateUser']);

        Route::get('/user/{user}/senha', [LoginController::class, 'showCheckPassword'])->name('user.login.password');
        Route::post('/user/{user}/senha', [LoginController::class, 'checkPassword']);

        Route::get('/user/{user}/choose-company', [LoginController::class, 'showChooseCompany'])->name('user.login.choose-company');
        Route::post('/user/{user}/choose-company/{company?}', [LoginController::class, 'chooseCompany'])->name('user.login.login-with-company');
    });

    Route::prefix('forgot-password')->group(function(){
        Route::get('/company', [CompanyController::class, 'showForgotPassword'])->name('company.password.request');
        Route::post('/company', [CompanyController::class, 'sendResetEmail'])->name('company.password.email');
        
        Route::get('/user', [ResetUserPasswordController::class, 'forgot'])->name('user.password.request');
        Route::post('/user', [ResetUserPasswordController::class, 'send'])->name('user.password.email');
    });

    Route::prefix('reset-password')->group(function(){
        Route::get('/user/{token}', [ResetUserPasswordController::class, 'showReset'])->name('user.password.reset');
        Route::post('/user', [ResetUserPasswordController::class, 'reset'])->name('user.password.update');

        Route::get('/company/{token}', [CompanyController::class, 'showResetPassword'])->name('company.password.reset');
        Route::post('/company', [CompanyController::class, 'resetPassword'])->name('company.password.update');
    });
});

Route::middleware(AuthMiddleware::class)->group(function() {
    Route::prefix('welcome')->group(function(){
        Route::get('/company', [WelcomeController::class, 'welcomeCompany'])->name('welcome.company');
        Route::get('/user', [WelcomeController::class, 'welcomeUser'])->name('welcome.user');
    });

    Route::prefix('collection')->group(function(){
        Route::get('/{collection}/test/{test?}', TestsController::class)->name('answer-test');
        Route::post('/{collection}/test/{test}/send', [TestsController::class, 'handleTestSubmit'])->name('send-test');

        Route::view('/thanks', 'private.tests.thanks')->name('complete-tests.thanks');
    });

    Route::prefix('feedback')->group(function(){
        Route::get('/', [UserFeedbackController::class, 'index'])->name('feedback.index');
        Route::get('/{feedback}', [UserFeedbackController::class, 'show'])->name('feedback.show');
        Route::get('/create', [UserFeedbackController::class, 'create'])->name('feedback.create');
        Route::post('/create', [UserFeedbackController::class, 'store']);
        Route::get('/export', [UserFeedbackController::class, 'export'])->name('feedback.export');
    });

    Route::prefix('campaigns')->group(function(){
        Route::get('/', [CampaignController::class, 'index'])->name('campaign.index');
        Route::get('create', [CampaignController::class, 'create'])->name('campaign.create');
        Route::post('store', [CampaignController::class, 'store'])->name('campaign.store');
        Route::get('{campaign}', [CampaignController::class, 'show'])->name('campaign.show');
        Route::get('{campaign}/edit', [CampaignController::class, 'edit'])->name('campaign.edit');
        Route::put('{campaign}/update', [CampaignController::class, 'update'])->name('campaign.update');
        Route::delete('{campaign}/delete', [CampaignController::class, 'destroy'])->name('campaign.destroy');
        Route::post('{campaign}/notify', [CampaignController::class, 'notify'])->name('campaign.notify');
        Route::put('{campaign}/close', [CampaignController::class, 'close'])->name('campaign.close');
    });

    Route::prefix('action-plan')->group(function(){
        Route::get('{actionPlan}', [ActionPlanController::class, 'show'])->name('action-plan.show');

        Route::get('{actionPlan}/risk/{risk}/edit', [ActionPlanController::class, 'edit'])->name('action-plan.risk.edit');
        Route::put('{actionPlan}/risk/{risk}/update', [ActionPlanController::class, 'update'])->name('action-plan.risk.update');

        Route::post('{actionPlan}/risk/{risk}/medidas-de-controle/store', [CustomControlActionController::class, 'store'])->name('action-plan.risk.control-action.store');
        Route::get('{actionPlan}/risk/{risk}/medidas-de-controle/{controlAction}/delete', [CustomControlActionController::class, 'destroy'])->name('action-plan.risk.control-action.destroy');
    });

    Route::prefix('custom-collections')->group(function(){
        Route::get('/', [CustomCollectionController::class, 'index'])->name('custom-collections.index');
        Route::get('{customCollection}', [CustomCollectionController::class, 'show'])->name('custom-collections.show');
        Route::get('create', [CustomCollectionController::class, 'create'])->name('custom-collections.create');
        Route::post('store', [CustomCollectionController::class, 'store'])->name('custom-collections.store');
        Route::put('{customCollection}/update', [CustomCollectionController::class, 'update'])->name('custom-collections.update');
        Route::delete('{customCollection}/delete', [CustomCollectionController::class, 'destroy'])->name('custom-collections.destroy');
        
        Route::post('{customCollection}/tests/store', [CustomTestController::class, 'store'])->name('custom-collections.tests.store');
        Route::get('{customCollection}/tests/{customTest}/delete', [CustomTestController::class, 'destroy'])->name('custom-collections.tests.destroy');    
        
        Route::post('{customCollection}/questions/store', [CustomQuestionController::class, 'store'])->name('custom-collections.tests.questions.store');
        Route::get('{customCollection}/questions/{customQuestion}/delete', [CustomQuestionController::class, 'destroy'])->name('custom-collections.tests.questions.destroy');
    });

    Route::prefix('company-metrics')->group(function() {
        Route::get('/', [CompanyMetricsController::class, 'edit'])->name('company-metrics.edit');
        Route::post('/', [CompanyMetricsController::class, 'update'])->name('company-metrics.update');
    });

    Route::prefix('dashboard')->group(function () {
        Route::prefix('psychosocial')->group(function(){    
            Route::get('/', PsychosocialMainController::class)->name('dashboard.psychosocial');
            Route::get('/{testName}/{riskName}/departments', PsychosocialResultsByDepartmentController::class)->name('dashboard.psychosocial.department');
            Route::get('/{testName}/{riskName}/list', PsychosocialResultsListController::class)->name('dashboard.psychosocial.list');
            Route::get('/risks', PsychosocialRisksController::class)->name('dashboard.psychosocial.risks');
            Route::get('/risks/report', [PsychosocialRisksController::class, 'createPDFReport'])->name('dashboard.psychosocial.risks.report');
        });

        Route::prefix('organizational-climate')->group(function(){
            Route::get('/', OrganizationalMainController::class)->name('dashboard.organizational-climate');
            Route::post('/report', [OrganizationalMainController::class, 'createPDFReport'])->name('dashboard.organizational-climate.report');
            Route::get('/answers', OrganizationalAnswersController::class)->name('dashboard.organizational-climate.answers');
            Route::get('/answers/report', [OrganizationalAnswersController::class, 'createPDFReport'])->name('dashboard.organizational-climate.answers.report');
        });

        Route::get('/demographics', DemographicsMainController::class)->name('dashboard.demographics');
    });

    Route::prefix('company')->group(function(){
        Route::get('/{company}', [CompanyController::class, 'show'])->name('company.show');   
        Route::get('/{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');
        Route::put('/{company}', [CompanyController::class, 'update'])->name('company.update');   
        Route::delete('/{company}', [CompanyController::class, 'destroy'])->name('company.destroy');   
        Route::put('/{company}/reset-password', [CompanyController::class, 'resetPasswordModal'])->name('company.reset-password-modal');
    });

    Route::prefix('user')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/user/import', [UserController::class, 'showImport'])->name('user.import');
        Route::post('/user/import', [UserController::class, 'import']);
        
        Route::post('/verify-cpf', [UserController::class, 'verifyCPF'])->name('user.create.verify-cpf');
        Route::get('/{user}/permission', [UserController::class, 'showPermissions'])->name('user.permissions');
        Route::post('/{user}/permission', [UserController::class, 'updatePermissions']);
        Route::get('/{user}/department-scope', [UserController::class, 'showDepartmentScope'])->name('user.department-scope');
        Route::post('/{user}/department-scope', [UserController::class, 'updateDepartmentScopes']);

        Route::post('/switch-company', [LoginController::class, 'switchCompany'])->name('user.switch-company');

        Route::get('/{user}/reset-password', [UserController::class, 'showResetPassword'])->name('user.reset-password');
        Route::put('/{user}/reset-password', [UserController::class, 'resetPassword']);
        
        Route::put('/{user}/reset-password-modal', [UserController::class, 'resetPasswordModal'])->name('user.reset-password-modal');
    });
    
    Route::view('/politica-de-privacidade', 'private.lgpd.privacy-policy')->name('privacy-policy');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});
