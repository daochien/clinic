<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->where('email', 'admin@gmail.com')->delete();

        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123'),
            'note' => '',
        ]);

        DB::table('role_user')->insert([
            'role_id' => '1',
            'user_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
