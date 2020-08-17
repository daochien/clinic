<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeAdmin extends Mailable
{
    use SerializesModels;

    public $user;

    public $rawPassword;
    public $authUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->user = $event->user;
        $this->rawPassword = $event->rawPassword;
        $this->authUser = $event->authUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("[{$this->user->name}] Welcome to " . config('app.name'))
            ->markdown('emails.welcome-user');
    }
}
