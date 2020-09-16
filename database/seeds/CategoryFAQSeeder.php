<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryFAQSeeder extends Seeder
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
                    'name' => 'タイムカード関連',
                    'description' => 'タイムカード関連',
                    'type' => \App\Models\Category::TYPE['faq'],
                ],
                [
                    'name' => '一般編',
                    'description' => '一般編',
                    'type' => \App\Models\Category::TYPE['faq'],
                ],
                [
                    'name' => '日計表関連',
                    'description' => '日計表関連',
                    'type' => \App\Models\Category::TYPE['faq'],
                ],
                [
                    'name' => '健康診断関連',
                    'description' => '健康診断関連',
                    'type' => \App\Models\Category::TYPE['faq'],
                ],
                [
                    'name' => '給与編',
                    'description' => '給与編',
                    'type' => \App\Models\Category::TYPE['faq'],
                ],
            ]
        );
    }
}
