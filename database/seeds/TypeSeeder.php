<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insertOrIgnore(
            [
                [
                    'name' => '医師',
                    'description' => 'Doctor',
                ],
                [
                    'name' => 'ナース',
                    'description' => 'Nurse',
                ],
                [
                    'name' => '役員',
                    'description' => 'Back office',
                ],
                [
                    'name' => '他の',
                    'description' => 'Other',
                ],
            ]
        );
    }
}
