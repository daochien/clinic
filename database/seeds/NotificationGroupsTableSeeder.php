<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $group1 = DB::table('groups')->where('name', '全員')->first();
        // DB::table('notification_groups')->truncate();
        // DB::table('notification_groups')->insert([
        //     [
        //         'notification_id' => 1,
        //         'group_id' => $group1->id,
        //     ],
        //     [
        //         'notification_id' => 2,
        //         'group_id' => $group1->id,
        //     ],
        //     [
        //         'notification_id' => 3,
        //         'group_id' => $group1->id,
        //     ],
        //     [
        //         'notification_id' => 4,
        //         'group_id' => $group1->id,
        //     ],
        //     [
        //         'notification_id' => 5,
        //         'group_id' => $group1->id,
        //     ],
        // ]);
    }
}
