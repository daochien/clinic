<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->truncate();
        DB::table('groups')->insert([
            [
                'name' => '全員',
                'description' => '全員',
            ],
            [
                'name' => '医師',
                'description' => '医師',
            ],
            [
                'name' => '衛生士',
                'description' => '衛生士',
            ],
            [
                'name' => 'administrator',
                'description' => 'Administrator',
            ],
            [
                'name' => 'room',
                'description' => 'Admin Room',
            ],
        ]);
    }
}
