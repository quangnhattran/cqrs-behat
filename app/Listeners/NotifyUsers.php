<?php

namespace App\Listeners;

use App\Repositories\UserRepository;
use App\Notifications\NewPostNotification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUsers implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public ?string $queue = 'notify_new_posts_queue';

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(object $event)
    {
        UserRepository::all()->each(function (User $user) use ($event) {
            $user->notify(new NewPostNotification($event->post));
        });
    }
}
