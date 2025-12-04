<?php

use App\Http\Controllers\CMS\CMSLogoutController;
use App\Http\Controllers\CMS\CMSPsychosocialController;
use App\Http\Controllers\CMS\CMSReportChannelController;
use App\Http\Controllers\ControlActionsController;
use App\Http\Controllers\Private\Campaign\CampaignController;
use App\Http\Controllers\Private\Company\CompanyController;
use App\Http\Controllers\Private\OrganizationalController;
use App\Http\Controllers\Private\Psychosocial\PsychosocialController;
use App\Http\Controllers\Private\Test\TestController;
use App\Http\Controllers\Private\User\UserController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\CMSAuthMiddleware;
use App\Http\Middleware\CMSGuestMiddleware;
use App\Http\Middleware\GuestMiddleware;
use Illuminate\Support\Facades\Route;

Route::view('/', 'site.home.index')->name('site.home');
Route::view('/privacy-policy', 'site.privacy-policy.index')->name('site.privacy-policy');
Route::view('/terms-of-use', 'site.terms-of-use.index')->name('site.terms-of-use');


Route::middleware(GuestMiddleware::class)->group(function() {
    Route::prefix('register')->group(function(){
        Route::get('/company', [CompanyController::class, 'register'])->name('company.register');
    });

    Route::prefix('login')->group(function(){
        Route::get('/company', [CompanyController::class, 'login'])->name('company.login');
        Route::get('/user', [UserController::class, 'login'])->name('user.login');
    });

    Route::prefix('forgot-password')->group(function(){
        Route::get('/company', [CompanyController::class, 'forgotPassword'])->name('company.password-request'); 
        Route::get('/user', [UserController::class, 'forgotPassword'])->name('user.password-request');
    });

    Route::prefix('reset-password')->group(function(){
        Route::get('/company/{token}', [CompanyController::class, 'resetPassword'])->name('company.password-reset');
        Route::get('/user/{token}', [UserController::class, 'resetPassword'])->name('user.password.reset');
    });
});

Route::middleware(AuthMiddleware::class)->group(function() {
    Route::prefix('home')->group(function(){
        Route::get('/company', [CompanyController::class, 'home'])->name('home.company');
        Route::get('/user', [UserController::class, 'home'])->name('home.user');
    });

    Route::prefix('test')->group(function(){
        Route::get('/{campaign}/answer', [TestController::class, 'show'])->name('answer-test');
        Route::view('/thanks', 'private.test.thanks')->name('test.thanks');
    });

    Route::prefix('psychosocial')->group(function () {
        Route::get('/dashboard', [PsychosocialController::class, 'dashboard'])->name('psychosocial.dashboard');
        Route::get('/indicators', [PsychosocialController::class, 'indicators'])->name('psychosocial.indicators');
        Route::get('/absences', [PsychosocialController::class, 'absences'])->name('psychosocial.absences');
    });

    
    // Route::prefix('company-metrics')->group(function() {
    //     Route::get('/', [MetricsController::class, 'edit'])->name('company-metrics.edit');
    //     Route::post('/', [MetricsController::class, 'update'])->name('company-metrics.update');
    // });

    // Route::prefix('company-absence')->group(function() {
    //     Route::get('/', [AbsencesController::class, 'index'])->name('company-absence.index');
    // });

    // Route::prefix('company-reports')->group(function() {
    //     Route::post('/', [ReportsController::class, 'update'])->name('company-reports.update');
    // });

    Route::prefix('organizational')->group(function () {
        Route::get('/dashboard', [OrganizationalController::class, 'dashboard'])->name('organizational.dashboard');
    });

    Route::prefix('campaign')->group(function(){
        Route::get('/', [CampaignController::class, 'index'])->name('campaign.index');
        Route::get('create', [CampaignController::class, 'create'])->name('campaign.create');
        Route::get('{campaign}/edit', [CampaignController::class, 'edit'])->name('campaign.edit');
    });

    Route::prefix('company')->group(function(){
        Route::get('/{company}/show', [CompanyController::class, 'show'])->name('company.show');

        Route::prefix('user')->group(function(){
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::get('/create', [UserController::class, 'create'])->name('user.create');
            Route::get('/import', [UserController::class, 'import'])->name('user.import');
            Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
        });
    });



   


    // Route::prefix('organizational-climate')->group(function(){
    //     // Route::get('/', [OrganizationalController::class, 'dashboard'])->name('dashboard.organizational-climate');
    //     Route::get('/', OrganizationalMainController::class)->name('dashboard.organizational-climate');
    //     Route::post('/report', [OrganizationalMainController::class, 'createPDFReport'])->name('dashboard.organizational-climate.report');
    //     Route::get('/answers', OrganizationalAnswersController::class)->name('dashboard.organizational-climate.answers');
    //     Route::get('/answers/report', [OrganizationalAnswersController::class, 'createPDFReport'])->name('dashboard.organizational-climate.answers.report');
    // });

    //     Route::get('/demographics', [DemographicsController::class, 'demographics'])->name('dashboard.demographics');


    // Route::prefix('feedback')->group(function(){
    //     Route::get('/', [UserFeedbackController::class, 'index'])->name('feedback.index');
    //     Route::get('/create', [UserFeedbackController::class, 'create'])->name('feedback.create');
    //     Route::post('/create', [UserFeedbackController::class, 'store']);
    //     Route::get('/export', [UserFeedbackController::class, 'export'])->name('feedback.export');
    //     Route::get('/{feedback}', [UserFeedbackController::class, 'show'])->name('feedback.show');
    // });



    Route::prefix('control-actions')->group(function() {
        Route::get('/', [ControlActionsController::class, 'edit'])->name('control-actions.update');
        Route::put('/', [ControlActionsController::class, 'update']);
    });

    // Route::prefix('custom-collections')->group(function(){
    //     Route::get('/', [CustomCollectionController::class, 'index'])->name('custom-collections.index');
    //     Route::get('{customCollection}', [CustomCollectionController::class, 'show'])->name('custom-collections.show');
    //     Route::get('create', [CustomCollectionController::class, 'create'])->name('custom-collections.create');
    //     Route::post('store', [CustomCollectionController::class, 'store'])->name('custom-collections.store');
    //     Route::put('{customCollection}/update', [CustomCollectionController::class, 'update'])->name('custom-collections.update');
    //     Route::delete('{customCollection}/delete', [CustomCollectionController::class, 'destroy'])->name('custom-collections.destroy');
        
    //     Route::post('{customCollection}/tests/store', [CustomTestController::class, 'store'])->name('custom-collections.tests.store');
    //     Route::get('{customCollection}/tests/{customTest}/delete', [CustomTestController::class, 'destroy'])->name('custom-collections.tests.destroy');    
        
    //     Route::post('{customCollection}/questions/store', [CustomQuestionController::class, 'store'])->name('custom-collections.tests.questions.store');
    //     Route::get('{customCollection}/questions/{customQuestion}/delete', [CustomQuestionController::class, 'destroy'])->name('custom-collections.tests.questions.destroy');
    // });


    
    Route::view('/politica-de-privacidade', 'private.lgpd.privacy-policy')->name('privacy-policy');
});

/*------------------------- CMS -------------------------------*/ 

Route::middleware(CMSGuestMiddleware::class)->group(function(){
    Route::view('/cms', 'cms.auth.login')->name('cms.login');
});

Route::middleware(CMSAuthMiddleware::class)->group(function(){
    Route::prefix('cms')->group(function(){
        Route::prefix('psychosocial')->group(function(){
            Route::get('/dashboard', [CMSPsychosocialController::class, 'dashboard'])->name('cms.psychosocial.dashboard');
            Route::get('/company', [CMSPsychosocialController::class, 'companyIndex'])->name('cms.psychosocial.company.index');
            Route::get('/company/create', [CMSPsychosocialController::class, 'companyCreate'])->name('cms.psychosocial.company.create');
            Route::get('/company/{company}', [CMSPsychosocialController::class, 'companyShow'])->name('cms.psychosocial.company.show');

            Route::get('/company/{company}/user', [CMSPsychosocialController::class, 'userIndex'])->name('cms.psychosocial.user.index');
            Route::get('/company/{company}/user/create', [CMSPsychosocialController::class, 'userCreate'])->name('cms.psychosocial.user.create');
            Route::get('/company/{company}/user/import', [CMSPsychosocialController::class, 'userImport'])->name('cms.psychosocial.user.import');
            Route::get('/company/{company}/user/{user}', [CMSPsychosocialController::class, 'userShow'])->name('cms.psychosocial.user.show');
        });

        Route::prefix('report-channel')->group(function(){
            Route::get('/dashboard', [CMSReportChannelController::class, 'dashboard'])->name('cms.report-channel.dashboard');
            Route::get('/company', [CMSReportChannelController::class, 'companyIndex'])->name('cms.report-channel.company.index');
            Route::get('/company/create', [CMSReportChannelController::class, 'companyCreate'])->name('cms.report-channel.company.create');
            Route::get('/company/{companyID}', [CMSReportChannelController::class, 'companyShow'])->name('cms.report-channel.company.show');

            Route::get('/user', [CMSReportChannelController::class, 'userIndex'])->name('cms.report-channel.user.index');
            Route::get('/user/create', [CMSReportChannelController::class, 'userCreate'])->name('cms.report-channel.user.create');
            Route::get('/user/{userID}', [CMSReportChannelController::class, 'userShow'])->name('cms.report-channel.user.show');
        });

        Route::get('/logout', [CMSLogoutController::class, 'logout'])->name('cms.logout');
    });
});