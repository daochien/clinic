<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insertOrIgnore(
            [
                [
                    'name' => 'Admin',
                    'guard_name' => 'api',
                ],
                [
                    'name' => 'User',
                    'description' => 'api',
                ],
            ]
        );
    }
}
