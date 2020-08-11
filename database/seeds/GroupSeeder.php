<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = \App\Models\Type::get();

        if (!empty($types)) {
            $groups = [];
            foreach ($types as $type) {
                $groups[] = [
                    'name' => $type->name
                ];
            }
            \App\Models\Group::insertOrIgnore($groups);
        }
    }
}
