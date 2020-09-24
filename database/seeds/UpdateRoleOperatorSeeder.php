<?php

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateRoleOperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_has_permissions')->whereIn('role_id', [3, 4])->delete();
        $roleWeb = Role::find(3);
        $roleWeb->givePermissionTo([
            'notification.index',
            'notification.members',
            'notification.show',
            'notification.search',
            'notification.search.detail',
            'page.index',
            'page.blogs',
            'page.blogLatest',
            'page.manualLatest',
            'page.faqLatest',
            'page.show',
            'category.list.by.type',
            'profile.index',
            'profile.change.my.password',
            // 'api.logout'
        ]);

        $roleMobile = Role::find(4);
        $roleMobile->givePermissionTo([
            'clinic.show',
            'clinic.index',
            'clinic.update',
            'clinic.add.users',
            'clinic.get.users',
            'user.index',
            'profile.index',
            'profile.change.my.password',
            // 'api.logout',
            'category.list.by.type',
            'template.index',
            'api.template.show',
            'api.request.show',
            'api.request.list',
            'api.request.change_status',
            'api.request.comment',
            'api.request.store',
            'notification.index',
            'notification.members',
            'notification.show',
            'notification.search',
            'notification.search.detail',
            'page.index',
            'page.blogs',
            'page.blogLatest',
            'page.manualLatest',
            'page.faqLatest',
            'page.show',
            'api.inquiry.list',
            'api.inquiry.store',
            'api.inquiry.show',
            'api.inquiry.change_status',
            'api.inquiry.comment'
        ]);
    }
}
