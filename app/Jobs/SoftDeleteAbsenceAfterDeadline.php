<?php

namespace App\Jobs;

use App\Models\CompanyAbsence;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SoftDeleteAbsenceAfterDeadline implements ShouldQueue
{
    use Queueable;

    protected CompanyAbsence $absence;

    public function __construct(CompanyAbsence $absence)
    {
        $this->absence = $absence;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if(!$this->absence->trashed()) $this->absence->delete();
    }
}
