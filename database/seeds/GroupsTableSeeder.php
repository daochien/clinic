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
        DB::table('groups')->insert([
            [
                'name' => '全員',
                'description' => '全員',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '医師',
                'description' => '医師',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '衛生士',
                'description' => '衛生士',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'administrator',
                'description' => 'Administrator',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'room',
                'description' => 'Admin Room',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
