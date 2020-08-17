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
                    'name' => 'DR',
                    'description' => 'Doctor',
                ],
                [
                    'name' => 'DH',
                    'description' => 'Nurse',
                ],
                [
                    'name' => 'Other',
                    'description' => 'Other',
                ],
            ]
        );
    }
}
