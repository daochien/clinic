<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTemplateSeeder extends Seeder
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
                    'name' => 'スタッフ管理担当',
                    'description' => 'スタッフ管理担当',
                    'type' => \App\Models\Category::TYPE['template'],
                ],
                [
                    'name' => '問い合わせ担当',
                    'description' => '問い合わせ担当',
                    'type' => \App\Models\Category::TYPE['template'],
                ],
                [
                    'name' => '支払系承認担当',
                    'description' => '支払系承認担当',
                    'type' => \App\Models\Category::TYPE['template'],
                ],
                [
                    'name' => '労務管理系承認担当',
                    'description' => '労務管理系承認担当',
                    'type' => \App\Models\Category::TYPE['template'],
                ],
            ]
        );
    }
}
