<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

class TestJob implements ShouldQueue
{
    use Queueable;

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->department = Str::random(10);
        $this->user->save();
        // Imprime no console quando o job é processado
        echo $this->user->department . PHP_EOL;
    }
}
