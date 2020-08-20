<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create role super_user
        $roleSuperUser = Role::create([
            'name' => 'super_user',
            'guard_name' => 'api'
        ]);

        $superPermissions = $this->getPermissions();
        $roleSuperUser->givePermissionTo($superPermissions);
    
        //create role admin
        $roleAdmin = Role::create([
            'name' => 'admin',
            'guard_name' => 'api'
        ]);

        $adminPermissions = $this->getPermissions(['role', 'group']);
        $roleAdmin->givePermissionTo($adminPermissions);
        
        //create role operator
        $roleOperator = Role::create([
            'name' => 'operator',
            'guard_name' => 'api'
        ]);

        $operatorPermissions = $this->getPermissions(['role', 'group', 'manager']);
        $roleOperator->givePermissionTo($operatorPermissions);

        // DB::table('roles')->insertOrIgnore(
        //     [
        //         [
        //             'name' => 'Admin',
        //             'guard_name' => 'api',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ],
        //         [
        //             'name' => 'User',
        //             'guard_name' => 'api',
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ],
        //     ]
        // );
    }

    public function getPermissions($ignore = [])
    {
        $routes = config('router');
        $permissions = array();
        foreach ($routes as $key => $router) {
            if (!in_array($key, $ignore)) {
                foreach ($router['groups'] as $group) {
                    $permissions = array_merge($permissions, $group['routes']);
                }
            }            
        }
        $permissions = array_unique($permissions);

        $permissionsExists = DB::table('permissions')->whereIn('name', $permissions)->pluck('name')->toArray();

        $insertPermissions = [];
        foreach ($permissions as $item) {
            if (!in_array($item, $permissionsExists)) {
                $insertPermissions[] = [
                    'name' => $item,
                    'guard_name' => 'api'
                ];
            }
        }
        if (!empty($insertPermissions)) {
            DB::table('permissions')->insert($insertPermissions);
        }
    
        return $permissions;
    }
}
