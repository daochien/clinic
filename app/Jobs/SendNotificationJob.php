<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Models\NotificationUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $notificationId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->notificationId = $data['notification_id'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notification = Notification::where('id', $this->notificationId)->first();
        $notificationUsers = NotificationUser::where('notification_id', $this->notificationId)->get();
        foreach ($notificationUsers as $notificationUser) {
            PublishNotificationJob::dispatch([
                'title' => $notification->title,
                'content' => $notification->content,
                'user_id' => $notificationUser->user_id,
            ])->onQueue('publish-notification');
        }
    }
}
