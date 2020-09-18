<?php

namespace App\Services;

use App\Models\RequestLog;
use App\Models\Submission;
use Illuminate\Support\Facades\DB;

class RequestLogService
{

    public function __construct()
    {
    }

    /**
     * @param $requestId
     * @param $userId
     * @param $status
     */
    public function createLog($requestId, $userId, $status): void
    {
        RequestLog::updateOrCreate(
            [
                'request_id' => $requestId,
                'approver_id' => $userId
            ],
            [
                'status' => $status
            ]
        );
    }
}
