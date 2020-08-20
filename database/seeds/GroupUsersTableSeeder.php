<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = DB::table('users')->where('email', 'admin@gmail.com')->first();
        $group1 = DB::table('groups')->where('name', 'DR')->first();
        $group2 = DB::table('groups')->where('name', 'DH')->first();
        $group3 = DB::table('groups')->where('name', 'Other')->first();
        DB::table('group_users')->truncate();
        DB::table('group_users')->insert([
            [
                'user_id' => $user->id,
                'group_id' => $group1->id
            ],
            [
                'user_id' => $user->id,
                'group_id' => $group2->id
            ],
            [
                'user_id' => $user->id,
                'group_id' => $group3->id
            ]
        ]);
    }
}
