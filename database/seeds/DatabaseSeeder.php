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
//        $this->call(GroupUsersTableSeeder::class);
        //        $this->call(CategoriesTableSeeder::class);
        //        $this->call(TagsTableSeeder::class);
        //        $this->call(ProductsTableSeeder::class);
        //duplicate product for data
        //        $this->call(ProductsTableSeeder::class);
        //        $this->call(GroupsTableSeeder::class);

        //        $this->call(NotificationsTableSeeder::class);
        //        $this->call(NotificationGroupsTableSeeder::class);
    }
}
