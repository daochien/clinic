<?php

namespace App\Jobs;

use App\Models\UserDeviceToken;
use App\Services\SNSService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PublishNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $message;
    private $userId;

    /**
     * Create a new job instance.
     *
     * @param $message
     * @param $userId
     */
    public function __construct($data)
    {
        $this->message['title'] = $data['title'];
        $this->message['content'] = $data['content'];
        $this->userId = $data['user_id'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $userDevices = UserDeviceToken::from('user_device_tokens as ut')
            ->join('users as u', 'u.id', 'ut.user_id')
            ->where('ut.user_id', $this->userId)
            ->whereNull('u.deleted_at')
            ->whereNotNull('ut.arn')->get();
        $SNSService = app(SNSService::class);
        foreach ($userDevices as $userDevice) {
            try {
                $SNSService->publish([
                    'arn' => $userDevice->arn,
                    'title' => $this->message['title'],
                    'content' => $this->message['content'],
                ]);
            } catch (\Exception $exception) {
                Log::channel('notification')->info("Notification Error {$userDevice->user_id} _ {$userDevice->id}: {$exception->getMessage()}");
                report($exception);
            }
        }
    }
}
