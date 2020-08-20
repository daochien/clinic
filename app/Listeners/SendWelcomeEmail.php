<?php

namespace App\Listeners;

use App\Events\CreateUserEvent;
use App\Mail\WelcomeUser;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail implements ShouldQueue
{
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'redis';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'mail';

    /**
     * Handle the event.
     *
     * @param  CreateUserEvent  $event
     */
    public function handle(CreateUserEvent $event)
    {
        \Mail::to($event->user->email)->send(new WelcomeUser($event));
    }
}
