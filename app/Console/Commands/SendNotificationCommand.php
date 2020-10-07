<?php

namespace App\Console\Commands;

use App\Jobs\SendNotificationJob;
use App\Models\Notification;
use Illuminate\Console\Command;

class SendNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $notifications = Notification::where('schedule_date', '<=', now())->where('schedule_date', '>', now()->subMinutes(100))->where('draft', 0)->get();
        var_dump($notifications->toArray());
        foreach ($notifications as $notification) {
            SendNotificationJob::dispatch([
                'notification_id' => $notification->id,
            ])->onQueue('notification');
        }
        return 0;
    }
}
