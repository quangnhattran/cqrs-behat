<?php

namespace App\Console\Commands;

use App\Events\PostCreated;
use App\Jobs\PreQueueCheck;
use App\Models\Post;
use Illuminate\Console\Command;

class NotifyUsers extends Command
{
    use PreQueueCheck;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users about new post';

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
    public function handle()
    {
        $this->rabbitMQCheck('notifier');
        event(new PostCreated(Post::first()));
    }
}
