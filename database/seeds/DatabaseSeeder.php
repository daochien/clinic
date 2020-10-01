<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTemplateSeeder::class);
        $this->call(CategoriesInquirySeeder::class);
        $this->call(CategoryFAQSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(UpdateRoleOperatorSeeder::class);
    }
}
