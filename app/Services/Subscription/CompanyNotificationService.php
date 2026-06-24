<?php

namespace App\Services\Subscription;

use App\Enums\Subscription\PaymentType;
use App\Mail\NewCompanyNotificationMail;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;

class CompanyNotificationService
{
    public static function notifyExternalCompany(Company $company): void {
        foreach (self::ownerEmails() as $email) {
            Mail::to($email)->queue(new NewCompanyNotificationMail($company, null, null));
        }
    }

    public static function notifySubscriptionCompany(Company $company, int $employeesCount, PaymentType $paymentType): void {
        foreach (self::ownerEmails() as $email) {
            Mail::to($email)->queue(new NewCompanyNotificationMail($company, $employeesCount, $paymentType));
        }
    }

    public static function ownerEmails(): array
    {
        return array_map('trim', explode(',', env('OWNER_EMAILS')));
    }
}
