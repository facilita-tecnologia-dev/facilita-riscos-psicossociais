<?php

namespace App\Services\Subscription;

use App\Mail\MonthlyBusinessReportMail;
use App\Models\Company;
use App\Models\UserCollection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class MonthlyBusinessReportService
{
    public static function send(): void
    {
        $report = self::build();

        foreach (self::ownerEmails() as $email) {
            Mail::to($email)->queue(new MonthlyBusinessReportMail($report));
        }
    }

    private static function build(): array
    {
        // $start = now()->subMonth()->startOfMonth();
        // $end = now()->subMonth()->endOfMonth();
        $start = now()->startOfMonth();
        $end = now()->endOfMonth();

        $companiesCreated = Company::query()
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $subscriptionCompanies = Company::query()
            ->whereBetween('created_at', [$start, $end])
            ->where('billing_managed_externally', false)
            ->count();

        $externalBillingCompanies = Company::query()
            ->whereBetween('created_at', [$start, $end])
            ->where('billing_managed_externally', true)
            ->count();

        $answeredQuestionnaires = UserCollection::query()
            ->whereBetween('created_at', [$start, $end])
            ->count();

        return [
            'month' => Carbon::parse($start)->translatedFormat('F/Y'),
            'companies_created' => $companiesCreated,
            'subscription_companies' => $subscriptionCompanies,
            'external_billing_companies' => $externalBillingCompanies,
            'questionnaires_answered' => $answeredQuestionnaires,
        ];
    }

    private static function ownerEmails(): array
    {
        return array_filter(array_map( 'trim', explode(',', env('OWNER_EMAILS', ''))));
    }
}