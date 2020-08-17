<?php

namespace App\Listeners;

use App\Events\CreateAdminEvent;
use App\Mail\WelcomeAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeAdminEmail implements ShouldQueue
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
     * @param  CreateAdminEvent  $event
     */
    public function handle(CreateAdminEvent $event)
    {
        \Mail::to($event->user->email)->send(new WelcomeAdmin($event));
    }
}
