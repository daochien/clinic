<?php

namespace App\Listeners;

use App\Events\ChangeRequestStatusEvent;
use App\Models\RequestLog;
use App\Models\Submission;

class UpdateRequestStatus
{
    /**
     * Handle the event.
     *
     * @param  ChangeRequestStatusEvent  $event
     */
    public function handle(ChangeRequestStatusEvent $event)
    {
        $requestLog = $event->submission->requestLogs;
        $approverList = $event->form->approvers->pluck('id');
        $approvedCount = 0;

        foreach ($requestLog as $log) {
            $validApprover = in_array($event->approver->id, $approverList->toArray());
            if ($validApprover){
                if ($log->status === RequestLog::STATUS['reject']) {
                    $event->submission->update(['status' => Submission::STATUS['rejected']]);
                    return;
                }
                $approvedCount++;
                if (!$event->form->multi_approve || $approvedCount === $approverList->count()) {
                    $event->submission->update(['status' => Submission::STATUS['approved']]);
                    return;
                }
            }
        }

        if ($approvedCount > 0 && $approvedCount < $approverList->count()) {
            $event->submission->update(['status' => Submission::STATUS['processing']]);
        }
    }
}
