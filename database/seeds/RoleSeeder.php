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
            'id' => 1,
            'name' => 'super_user',
            'guard_name' => 'web'
        ]);

        $superPermissions = $this->getPermissions();
        $roleSuperUser->givePermissionTo($superPermissions);

        //create role admin
        $roleAdmin = Role::create([
            'id' => 2,
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $adminPermissions = $this->getPermissions(['role', 'group']);
        $roleAdmin->givePermissionTo($adminPermissions);

        //create role operator
        $roleWeb = Role::create([
            'id' => 3,
            'name' => 'staff_web',
            'guard_name' => 'web'
        ]);

        $webPermissions = $this->getPermissions(['role', 'group', 'manager']);
        $roleWeb->givePermissionTo($webPermissions);

         //create role operator
        $roleMobile = Role::create([
            'id' => 4,
            'name' => 'staff_mobile',
            'guard_name' => 'web'
        ]);

        $mobilePermissions = $this->getPermissions(['role', 'group', 'manager']);
        $roleMobile->givePermissionTo($mobilePermissions);

        //create role operator
        // $roleStaff = Role::create([
        //     'id' => 5,
        //     'name' => 'staff_management',
        //     'guard_name' => 'web'
        // ]);

        // $staffPermissions = $this->getPermissions(['role', 'group', 'manager', 'clinic', 'notification', 'request_template']);
        // $roleStaff->givePermissionTo($staffPermissions);

        // //create role operator
        // $clinicStaff = Role::create([
        //     'id' => 6,
        //     'name' => 'clinic_management',
        //     'guard_name' => 'web'
        // ]);

        // $clinicPermissions = $this->getPermissions(['role', 'group', 'manager', 'staff', 'notification', 'request_template']);
        // $clinicStaff->givePermissionTo($clinicPermissions);

        // //create role operator
        // $requestStaff = Role::create([
        //     'id' => 7,
        //     'name' => 'template_management',
        //     'guard_name' => 'web'
        // ]);

        // $requestPermissions = $this->getPermissions(['role', 'group', 'manager', 'staff', 'notification', 'clinic']);
        // $requestStaff->givePermissionTo($requestPermissions);

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
                    'guard_name' => 'web'
                ];
            }
        }
        if (!empty($insertPermissions)) {
            DB::table('permissions')->insert($insertPermissions);
        }

        return $permissions;
    }
}
