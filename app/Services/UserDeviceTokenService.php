<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\UserDeviceToken;
use Illuminate\Support\Facades\Log;

class UserDeviceTokenService
{

    /**
     * @var SNSService
     */
    private $snsService;

    public function __construct(SNSService $snsService)
    {
        $this->snsService = $snsService;
    }

    public function saveArnToThisDevice($user, $data)
    {
        $deviceToken = UserDeviceToken::whereDeviceToke($data['device_token'])->first();
        if (!empty($deviceToken)) {
            return true;
        }
        $arnInfo = $this->snsService->getDeviceArn($data);
        if ($arnInfo['status']) {
            UserDeviceToken::create([
                'user_id' => $user->id,
                'platform' => $data['platform'],
                'device_token' => $data['device_token'],
                'arn' => $arnInfo['arn'],
            ]);
        } else {
            Log::error($arnInfo['message'], $arnInfo);
        }
    }
}
