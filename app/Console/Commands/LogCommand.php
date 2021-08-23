<?php

namespace App\Console\Commands;

use App\Jobs\LogJob;
use App\Jobs\PreQueueCheck;
use Illuminate\Console\Command;

class LogCommand extends Command
{
    use PreQueueCheck;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log {severity=critical} {--source=anonymous}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $source = $this->option('source');
        $severity = $this->argument('severity');

        $this->rabbitMQCheck($source . '.' . $severity);

        dispatch(new LogJob($severity));
    }
}
