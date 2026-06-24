<?php

namespace App\Console\Commands;

use App\Services\Subscription\MonthlyBusinessReportService;
use Illuminate\Console\Command;

class SendMonthlyBusinessReportCommand extends Command
{
    protected $signature = 'reports:monthly-business';
    protected $description = 'Send monthly business report to owners';

    public function handle(): int
    {
        MonthlyBusinessReportService::send();

        $this->info(
            'Monthly business report sent.'
        );

        return self::SUCCESS;
    }
}
