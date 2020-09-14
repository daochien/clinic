<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesInquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->insert(
            [
                [
                    'name' => '労務関係',
                    'description' => '労務関係',
                    'type' => \App\Models\Category::TYPE['inquiry'],
                ],
                [
                    'name' => '給与関係',
                    'description' => '給与関係',
                    'type' => \App\Models\Category::TYPE['inquiry'],
                ],
                [
                    'name' => '福利厚生',
                    'description' => '福利厚生',
                    'type' => \App\Models\Category::TYPE['inquiry'],
                ],
                [
                    'name' => 'その他',
                    'description' => 'その他',
                    'type' => \App\Models\Category::TYPE['inquiry'],
                ],
            ]
        );
    }
}
