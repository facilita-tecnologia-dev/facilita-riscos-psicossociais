<?php

use App\Models\Company;
use App\Services\ReportChannel\ReportChannelService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

uses(DatabaseTransactions::class);

// O Canal passou a exigir a chave da API: toda chamada daqui a manda como Bearer.
it('sends the channel API token on every call', function () {
    config(['services.report_channel.token' => 'chave-do-canal']);
    Http::fake(['*' => Http::response(true)]);

    ReportChannelService::hasReportChannel(Company::factory()->create());
    ReportChannelService::companies();

    Http::assertSentCount(2);
    Http::assertSent(fn (Request $request) => $request->hasHeader('Authorization', 'Bearer chave-do-canal'));
});
