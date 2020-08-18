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
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Web',
                    'guard_name' => 'web',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Mobile',
                    'guard_name' => 'api',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }
}
