<?php

use Illuminate\Database\Seeder;

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
                'postal_code' => '123',
                'address' => 'Tokyo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '医師',
                'description' => '医師',
                'postal_code' => '123',
                'address' => 'Tokyo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '衛生士',
                'description' => '衛生士',
                'postal_code' => '123',
                'address' => 'Tokyo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'administrator',
                'description' => 'Administrator',
                'postal_code' => '123',
                'address' => 'Tokyo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'room',
                'description' => 'Admin Room',
                'postal_code' => '123',
                'address' => 'Tokyo',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

    }
}
