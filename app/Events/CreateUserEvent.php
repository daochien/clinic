<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class CreateUserEvent
{
    use Dispatchable, SerializesModels;

    public $user;
    public $rawPassword;
    public $authUser;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $rawPassword)
    {
        $this->user = $user;
        $this->rawPassword = $rawPassword;
        $this->authUser = Auth::user();
    }
}
