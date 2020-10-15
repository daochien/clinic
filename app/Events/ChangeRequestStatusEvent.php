<?php

namespace App\Events;

use App\Models\Form;
use App\Models\Submission;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ChangeRequestStatusEvent
{
    use Dispatchable, SerializesModels;

    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public $approver;
    /**
     * @var Form
     */
    public $form;
    /**
     * @var Submission
     */
    public $submission;

    /**
     * Create a new event instance.
     * @param $submissionId
     */
    public function __construct($submissionId)
    {
        $this->submission = Submission::query()->where('id', $submissionId)->first();
        $this->form = $this->submission->form;
        $this->approver = Auth::user();
    }
}
