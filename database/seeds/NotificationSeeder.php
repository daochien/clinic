<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        try {
            DB::beginTransaction();
            $bodUser = \App\Models\User::where('email', 'bod@gmail.com')->first();
            if (!$bodUser) {
                $bodUser = \App\Models\User::insert([
                    'name' => 'bod',
                    'email' => 'bod@gmail.com',
                    'password' => \Illuminate\Support\Facades\Hash::make(123123),
                    'note' => 'bod',
                    'description' => 'bod',
                    'posittion' => \App\Models\User::POSITTION['BOD'],
                ]);
            }
            $bodUser = \App\Models\User::where('email', 'bod@gmail.com')->first();
            $hrUser = \App\Models\User::where('email', 'hr@gmail.com')->first();
            if (!$hrUser) {
                $hrUser = \App\Models\User::insert([
                    'name' => 'hr',
                    'email' => 'hr@gmail.com',
                    'password' => \Illuminate\Support\Facades\Hash::make(123123),
                    'note' => 'hr',
                    'description' => 'hr',
                    'posittion' => \App\Models\User::POSITTION['HR'],
                ]);
            }
            $hrUser = \App\Models\User::where('email', 'hr@gmail.com')->first();

            $notificationsData = [];
            for ($i = 1; $i <= 20; $i ++) {
                $notificationsData[] = [
                    'title' => "BOD Notification $i",
                    'content' => "BOD Notification content ". now() . ' - id ' . $i,
                    'confirm' => rand(0,1),
                    'draft' => 0,
                    'schedule_date' => now(),
                    'created_by' => $bodUser->id,
                ];
            }
            \App\Models\Notification::insert($notificationsData);

            $notificationsData = [];
            for ($i = 1; $i <= 20; $i ++) {
                $notificationsData[] = [
                    'title' => "HR Notification $i",
                    'content' => "HR Notification content ". now() . ' - id ' . $i,
                    'confirm' => rand(0,1),
                    'draft' => 0,
                    'schedule_date' => now(),
                    'created_by' => $hrUser->id,
                ];
            }
            \App\Models\Notification::insert($notificationsData);

            // create user webapp.
            $webappUser = \App\Models\User::where('email', 'webapp@gmail.com')->first();
            if (!$webappUser) {
                $webappUser = \App\Models\User::insert([
                    'id' => 9999,
                    'name' => 'webapp',
                    'email' => 'webapp@gmail.com',
                    'password' => \Illuminate\Support\Facades\Hash::make(123123),
                    'note' => 'webapp',
                    'description' => 'webapp',
                    'posittion' => 0,
                ]);
            }
            $webappUser = \App\Models\User::where('email', 'webapp@gmail.com')->first();

            $notificationUsersData = [];
            $notifications = \App\Models\Notification::all();
            foreach ($notifications as $notification) {
                $notificationUsersData[] = [
                    'user_id' => $webappUser->id,
                    'notification_id' => $notification->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $notificationUsers = DB::table('notification_users')->insert($notificationUsersData);
            DB::commit();
//        } catch (\Exception $e) {
//            var_dump($e->getMessage());
//            DB::rollBack();
//        }
    }
}
