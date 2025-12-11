<?php

use App\Http\Controllers\CMS\CMSLogoutController;
use App\Http\Controllers\CMS\CMSPsychosocialController;
use App\Http\Controllers\CMS\CMSReportChannelController;
use App\Http\Controllers\Private\Campaign\CampaignController;
use App\Http\Controllers\Private\Company\CompanyController;
use App\Http\Controllers\Private\Documentation\DocumentationController;
use App\Http\Controllers\Private\Organizational\OrganizationalController;
use App\Http\Controllers\Private\Psychosocial\PsychosocialController;
use App\Http\Controllers\Private\Test\TestController;
use App\Http\Controllers\Private\User\UserController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\CMSAuthMiddleware;
use App\Http\Middleware\CMSGuestMiddleware;
use App\Http\Middleware\GuestMiddleware;
use Illuminate\Support\Facades\Route;

Route::view('/', 'site.home.index')->name('site.home');
Route::view('/politica-de-privacidade', 'site.privacy-policy.index')->name('site.privacy-policy');
Route::view('/termos-de-uso', 'site.terms-of-use.index')->name('site.terms-of-use');


Route::middleware(GuestMiddleware::class)->group(function() {
    Route::prefix('cadastro')->group(function(){
        Route::get('/empresa', [CompanyController::class, 'register'])->name('company.register');
    });

    Route::prefix('login')->group(function(){
        Route::get('/empresa', [CompanyController::class, 'login'])->name('company.login');
        Route::get('/funcionario', [UserController::class, 'login'])->name('user.login');
    });

    Route::prefix('esqueceu-a-senha')->group(function(){
        Route::get('/empresa', [CompanyController::class, 'forgotPassword'])->name('company.password-request'); 
        Route::get('/funcionario', [UserController::class, 'forgotPassword'])->name('user.password-request');
    });

    Route::prefix('redefinir-senha')->group(function(){
        Route::get('/empresa/{token}', [CompanyController::class, 'resetPassword'])->name('company.password-reset');
        Route::get('/funcionario/{token}', [UserController::class, 'resetPassword'])->name('user.password.reset');
    });
});

Route::middleware(AuthMiddleware::class)->group(function() {
    Route::prefix('inicio')->group(function(){
        Route::get('/empresa', [CompanyController::class, 'home'])->name('home.company');
        Route::get('/funcionario', [UserController::class, 'home'])->name('home.user');
    });

    Route::prefix('campanha')->group(function(){
        Route::get('/', [CampaignController::class, 'index'])->name('campaign.index');
        Route::get('agendar', [CampaignController::class, 'create'])->name('campaign.create');
        Route::get('{campaign}/editar', [CampaignController::class, 'edit'])->name('campaign.edit');
        Route::get('/{campaign}/responder', [TestController::class, 'show'])->name('campaign.answer');
    });

    Route::prefix('riscos-psicossociais')->group(function () {
        Route::get('/dashboard', [PsychosocialController::class, 'dashboard'])->name('psychosocial.dashboard');
        Route::get('/indicadores', [PsychosocialController::class, 'indicators'])->name('psychosocial.indicators');
        Route::get('/afastamentos', [PsychosocialController::class, 'absences'])->name('psychosocial.absences');
        Route::get('/medidas-de-controle', [PsychosocialController::class, 'controlActions'])->name('psychosocial.control-action');
    });

    Route::prefix('clima-organizacional')->group(function () {
        Route::get('/dashboard', [OrganizationalController::class, 'dashboard'])->name('organizational.dashboard');
        Route::get('/feedback', [OrganizationalController::class, 'feedback'])->name('organizational.feedback');
        Route::get('/formularios', [OrganizationalController::class, 'customCollectionIndex'])->name('organizational.custom-collection.index');
        Route::get('/formularios/{customCollection}/editar', [OrganizationalController::class, 'customCollectionEdit'])->name('organizational.custom-collection.edit');
    });

    Route::prefix('empresa')->group(function(){
        Route::get('/{company}/perfil', [CompanyController::class, 'show'])->name('company.show');

        Route::prefix('funcionario')->group(function(){
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::get('/cadastrar', [UserController::class, 'create'])->name('user.create');
            Route::get('/importar', [UserController::class, 'import'])->name('user.import');
            Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
        });
    });

    Route::prefix('documentacao')->group(function(){
        Route::get('/', [DocumentationController::class, 'index'])->name('documentation.index');
        Route::get('/politica-de-privacidade', [DocumentationController::class, 'policy'])->name('documentation.policy');
    });
});

/*------------------------- CMS -------------------------------*/ 

Route::middleware(CMSGuestMiddleware::class)->group(function(){
    Route::view('/cms', 'cms.auth.login')->name('cms.login');
});

Route::middleware(CMSAuthMiddleware::class)->group(function(){
    Route::prefix('cms')->group(function(){
        Route::prefix('riscos-psicossociais')->group(function(){
            Route::get('/dashboard', [CMSPsychosocialController::class, 'dashboard'])->name('cms.psychosocial.dashboard');
            Route::get('/empresa', [CMSPsychosocialController::class, 'companyIndex'])->name('cms.psychosocial.company.index');
            Route::get('/empresa/cadastrar', [CMSPsychosocialController::class, 'companyCreate'])->name('cms.psychosocial.company.create');
            Route::get('/empresa/{company}', [CMSPsychosocialController::class, 'companyShow'])->name('cms.psychosocial.company.show');

            Route::get('/empresa/{company}/funcionario', [CMSPsychosocialController::class, 'userIndex'])->name('cms.psychosocial.user.index');
            Route::get('/empresa/{company}/funcionario/cadastrar', [CMSPsychosocialController::class, 'userCreate'])->name('cms.psychosocial.user.create');
            Route::get('/empresa/{company}/funcionario/importar', [CMSPsychosocialController::class, 'userImport'])->name('cms.psychosocial.user.import');
            Route::get('/empresa/{company}/funcionario/{user}', [CMSPsychosocialController::class, 'userShow'])->name('cms.psychosocial.user.show');
        });

        Route::prefix('report-channel')->group(function(){
            Route::get('/dashboard', [CMSReportChannelController::class, 'dashboard'])->name('cms.report-channel.dashboard');
            Route::get('/empresa', [CMSReportChannelController::class, 'companyIndex'])->name('cms.report-channel.company.index');
            Route::get('/empresa/cadastrar', [CMSReportChannelController::class, 'companyCreate'])->name('cms.report-channel.company.create');
            Route::get('/empresa/{companyID}', [CMSReportChannelController::class, 'companyShow'])->name('cms.report-channel.company.show');

            Route::get('/funcionario', [CMSReportChannelController::class, 'userIndex'])->name('cms.report-channel.user.index');
            Route::get('/funcionario/cadastrar', [CMSReportChannelController::class, 'userCreate'])->name('cms.report-channel.user.create');
            Route::get('/funcionario/{userID}', [CMSReportChannelController::class, 'userShow'])->name('cms.report-channel.user.show');
        });

        Route::get('/logout', [CMSLogoutController::class, 'logout'])->name('cms.logout');
    });
});