export default [
    { path: '/admin/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/admin/profile', component: require('./components/admin/Profile.vue').default },

    {
        path: '/admin/clinic',
        component: { template: '<router-view/>' },
        name: 'clinic',meta: {breadcrumb: `スタッフ管理`},
        children: [
            { path: '', component: require('./components/admin/clinic/Index.vue').default, name: 'clinic.list', meta: {breadcrumb: `クリニック一覧`}},
            { path: ':id/edit',component: require('./components/admin/clinic/Edit.vue').default,name: 'clinic.edit',meta: {breadcrumb: `クリニック一覧`}},
            { path: 'create',component: require('./components/admin/clinic/Create.vue').default,name: 'clinic.create',meta: {breadcrumb: 'クリニック一覧'}},
            { path: ':id/user', component: require('./components/admin/clinic/Users.vue').default, name: 'clinic.user',meta: {breadcrumb: `クリニック一覧`}},
            { path: ':id/add-user', component: require('./components/admin/clinic/AddUsers.vue').default, name: 'clinic.add.user',meta: {breadcrumb: `クリニック一覧`}},
        ]
    },

    {
        path: '/admin/user',
        component: {template: '<router-view/>'},
        name: 'user', meta: {breadcrumb: `スタッフ管理`},
        children: [
            { path: '', component: require('./components/admin/user/Index.vue').default, name: 'user.list', meta: {breadcrumb: `スタッフ一覧`}},
            { path: '/admin/user/create', component: require('./components/admin/user/Create.vue').default, name: 'user.create', meta: {breadcrumb: `スタッフ一覧`}},
            { path: '/admin/user/:id/edit', component: require('./components/admin/user/Edit.vue').default, name: 'user.edit', meta: {breadcrumb: `スタッフ一覧`} },
        ]
    },

    {
        path: '/admin/template',
        component: {template: '<router-view/>'},
        name: 'user', meta: {breadcrumb: `申請管理`},
        children: [
            { path: '', component: require('./components/admin/template/Index.vue').default, meta: {breadcrumb: `申請テンプレート`} },
            { path: 'create', component: require('./components/admin/template/Create.vue').default , meta: {breadcrumb: `申請テンプレート`}},
        ]
    },

    { path: '*', component: require('./components/NotFound.vue').default },

    {
        path: '/admin/notification',
        component: {template: '<router-view/>'},
        name: 'user', meta: {breadcrumb: `お知らせ管理`},
        children: [
            { path: '', component: require('./components/admin/notifications/Index.vue').default, meta: {breadcrumb: `お知らせ一覧`} },
            { path: 'details', component: require('./components/admin/notifications/Details.vue').default, name: 'details_notification', meta: {breadcrumb: `お知らせ詳細情報`} },
            { path: 'edit', component: require('./components/admin/notifications/Edit.vue').default, name: 'edit_notification' , meta: {breadcrumb: `お知らせ一覧`}},
        ]
    },


    { path: '/admin/blog/create', component: require('./components/admin/blog/Create.vue').default },

    {
        path: '/admin/manager',
        component: {template: '<router-view/>'},
        name: 'admin', meta: {breadcrumb: `管理者アカウント管理`},
        children: [
            { path: '', component: require('./components/admin/manager/Managers.vue').default, meta: {breadcrumb: `管理者一覧`} },
            { path: 'create', component: require('./components/admin/manager/Manager.vue').default, meta: {breadcrumb: `管理者一覧`} },
            { path: 'edit/:id(\\d+)', component: require('./components/admin/manager/Manager.vue').default, meta: {breadcrumb: `管理者一覧`} },
            { path: 'roles', component: require('./components/admin/role/Roles.vue').default, meta: {breadcrumb: `管理者一覧`} },
        ]
    },

    {
        path: '/admin/group',
        component: {template: '<router-view/>'},
        name: 'group', meta: {breadcrumb: `Group`},
        children: [
            { path: '', component: require('./components/admin/group/Index.vue').default, meta: {breadcrumb: `List`} },
            { path: '/add', component: require('./components/admin/group/Add.vue').default, name:'add_group', meta: {breadcrumb: `List`} },
            { path: '/edit', component: require('./components/admin/group/Edit.vue').default, name:'edit_group', meta: {breadcrumb: `List`} },
            // { path: '/admin/group/users', component: require('./components/admin/group/Members.vue').default, name:'users_group', meta: {breadcrumb: `List`} },
        ]
    },


    {
        path: '/admin/role',
        component: {template: '<router-view/>'},
        name: 'role', meta: {breadcrumb: `Group`},
        children: [
            { path: 'create', component: require('./components/admin/role/Role.vue').default, meta: {breadcrumb: `Create`} },
            { path: '/admin/role/edit/:id', component: require('./components/admin/role/Role.vue').default, meta: {breadcrumb: `List`} },
        ]
    },
];
