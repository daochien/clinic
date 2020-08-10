<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insertOrIgnore(
            [
                [
                    'name' => 'CEO',
                    'description' => 'CEO',
                ],
                [
                    'name' => 'CFO',
                    'description' => 'CFO',
                ],
                [
                    'name' => 'COO',
                    'description' => 'COO',
                ],
            ]
        );
    }
}
