<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class LogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected ?string $severity;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(?string $severity)
    {
        $this->severity = $severity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::{$this->severity}('This is log message');
    }
}
