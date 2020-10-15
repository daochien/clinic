<?php

use App\Models\RequestLog;
use App\Models\Submission;
use Illuminate\Database\Seeder;

class UpdateRequestStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requests = Submission::all();
        foreach ($requests as $request) {
            $requestLog = $request->requestLogs;
            $form = $request->form;
            $approverList = $form->approvers->pluck('id');

            $approvedCount = 0;
            foreach ($requestLog as $log) {
                $validApprover = in_array($log->approver_id, $approverList->toArray());
                if ($validApprover){
                    if ($log->status === RequestLog::STATUS['reject']) {
                        $request->update(['status' => Submission::STATUS['rejected']]);
                        break;
                    }
                    $approvedCount++;
                    if (!$form->multi_approve || $approvedCount === $approverList->count()) {
                        $request->update(['status' => Submission::STATUS['approved']]);
                        break;
                    }
                }
            }

            if ($approvedCount > 0) {
                $request->update(['status' => Submission::STATUS['processing']]);
            }
        }
    }
}
