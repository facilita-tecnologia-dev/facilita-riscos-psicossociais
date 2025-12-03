<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

class TestJob implements ShouldQueue
{
    use Queueable;


    public function __construct(User $user)
    {
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Imprime no console quando o job é processado
        echo 'teste';
    }
}
