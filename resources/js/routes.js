export default [
    { path: '/notification', component: require('./components/client/notification/Index.vue').default },

    { path: '/blogs', component: require('./components/client/page/Page.vue').default, name: 'client.blog', meta: {breadcrumb: `グループ一覧 `} },
    { path: '/blogs/:id', component: require('./components/client/page/PageDetail.vue').default, name: 'client.blogDetail' },

    { path: '/manual', component: require('./components/client/page/Manual.vue').default, name: 'client.manual' },

    { path: '/my-account', component: require('./components/client/MyAccount').default, name: 'client.my.account' },

    { path: '/admin/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/admin/profile', component: require('./components/admin/Profile.vue').default },

    {
        path: '/admin/clinic',
        component: { template: '<router-view/>' },
        meta: {breadcrumb: `スタッフ管理`},
        children: [
            { path: '', component: require('./components/admin/clinic/Index.vue').default, name: 'clinic.list', meta: {breadcrumb: `クリニック一覧 `}},
            { path: ':id/edit',component: require('./components/admin/clinic/Edit.vue').default,name: 'clinic.edit',meta: {breadcrumb: `クリニック情報編集 `}},
            { path: 'create',component: require('./components/admin/clinic/Create.vue').default,name: 'clinic.create',meta: {breadcrumb: '新規クリニック登録 '}},
            { path: ':id/user', component: require('./components/admin/clinic/Users.vue').default, name: 'clinic.user',meta: {breadcrumb: `クリニックスタッフ一覧 `}},
            { path: ':id/add-user', component: require('./components/admin/clinic/AddUsers.vue').default, name: 'clinic.add.user',meta: {breadcrumb: `クリニックスタッフ登録 `}},
        ]
    },

    {
        path: '/admin/user',
        component: {template: '<router-view/>'},
        meta: {breadcrumb: `スタッフ管理`},
        children: [
            { path: '', component: require('./components/admin/user/Index.vue').default, name: 'user.list', meta: {breadcrumb: `スタッフ一覧`}},
            { path: 'create', component: require('./components/admin/user/Create.vue').default, name: 'user.create', meta: {breadcrumb: `新規スタッフ情報登録`}},
            { path: ':id/edit', component: require('./components/admin/user/Edit.vue').default, name: 'user.edit', meta: {breadcrumb: `スタッフ情報編集`} },
        ]
    },

    {
        path: '/admin/template',
        component: {template: '<router-view/>'},
        meta: {breadcrumb: `申請管理`},
        children: [
            { path: '', component: require('./components/admin/template/Index.vue').default, name:'template.list', meta: {breadcrumb: `申請テンプレート一覧`} },
        ]
    },

    {
        path: '/admin/request',
        component: {template: '<router-view/>'},
        meta: {breadcrumb: `申請管理`},
        children: [
            { path: '', component: require('./components/admin/request/Index.vue').default,meta: {breadcrumb: `申請一覧`}},
            { path: 'category/:id', component: require('./components/admin/request/Category.vue').default,meta: {
                    breadcrumb() {
                        if (this.$route.params.id == 1) {
                            return 'スタッフ管理担当の申請一覧'
                        } else if (this.$route.params.id == 2) {
                            return '問い合わせ担当の申請一覧'
                        } else if (this.$route.params.id == 3) {
                            return '支払系承認担当の申請一覧'
                        } else if (this.$route.params.id == 4) {
                            return '労務管理系承認担当の申請一覧'
                        } else {
                            return '申請一覧';
                        }
                    }
                }
            },
            { path: ':id', component: require('./components/admin/request/Request.vue').default, meta: {breadcrumb: `申請詳細情報`} },

        ]
    },

    {
        path: '/admin/inquiry',
        component: {template: '<router-view/>'},
        meta: {breadcrumb: `問合せ管理`},
        children: [
            { path: 'category/:id', component: require('./components/admin/inquiry/Category.vue').default,meta: {
                    breadcrumb() {
                        if (this.$route.params.id == 5) {
                            return '労務関係の問い合わせ一覧'
                        } else if (this.$route.params.id == 6) {
                            return '給与関係の問い合わせ一覧'
                        } else if (this.$route.params.id == 7) {
                            return '福利厚生の問い合わせ一覧'
                        } else if (this.$route.params.id == 8) {
                            return 'その他の問い合わせ一覧'
                        } else {
                            return '問合せ一覧';
                        }
                    }
                }
            },
            { path: ':id', component: require('./components/admin/inquiry/Inquiry.vue').default, meta: {breadcrumb: `問合せ詳細情報`} },

        ]
    },

    // { path: '*', component: require('./components/NotFound.vue').default },

    {
        path: '/admin/notification',
        component: {template: '<router-view/>'},
        meta: {breadcrumb: `お知らせ管理`},
        children: [
            { path: '', component: require('./components/admin/notifications/Index.vue').default, meta: {breadcrumb: `お知らせ一覧`} },
            { path: 'details/:id(\\d+)', component: require('./components/admin/notifications/Details.vue').default, name: 'details_notification', meta: {breadcrumb: `送信対象者一覧`} },
            { path: 'edit/:id(\\d+)', component: require('./components/admin/notifications/Edit.vue').default, name: 'edit_notification' , meta: {breadcrumb: `お知らせ編集`}},
            { path: 'create', component: require('./components/admin/notifications/Edit.vue').default, name: 'create_notification' , meta: {breadcrumb: `新規お知らせ作成`}},
        ]
    },


    { path: '/admin/blog/create', component: require('./components/admin/blog/Create.vue').default },

    {
        path: '/admin/manager',
        component: {template: '<router-view/>'},
        meta: {breadcrumb: `管理者アカウント管理`},
        children: [
            { path: '', component: require('./components/admin/manager/Managers.vue').default, meta: {breadcrumb: `管理者一覧`} },
            { path: 'create', component: require('./components/admin/manager/Manager.vue').default, meta: {breadcrumb: `新規アカウント登録`} },
            { path: 'edit/:id(\\d+)', component: require('./components/admin/manager/Manager.vue').default, meta: {breadcrumb: `管理者情報編集`} },
            { path: 'roles', component: require('./components/admin/role/Roles.vue').default, meta: {breadcrumb: `管理者役割一覧`} },
        ]
    },

    {
        path: '/admin/group',
        component: {template: '<router-view/>'},
        meta: {breadcrumb: `スタッフ管理`},
        children: [
            { path: '', component: require('./components/admin/group/Index.vue').default, meta: {breadcrumb: `グループ一覧 `} },
            { path: 'add', component: require('./components/admin/group/Add.vue').default, name:'add_group', meta: {breadcrumb: `新規グループ登録 `} },
            { path: 'edit', component: require('./components/admin/group/Edit.vue').default, name:'edit_group', meta: {breadcrumb: `グループ情報編集 `} },
            { path: 'users', component: require('./components/admin/group/Members.vue').default, name:'users_group', meta: {breadcrumb: `グループユーザー登録 `} },
        ]
    },


    {
        path: '/admin/role',
        component: {template: '<router-view/>'},
        meta: {breadcrumb: `役割管理`},
        children: [
            { path: '', component: require('./components/admin/role/Roles.vue').default, meta: {breadcrumb: `リストの役割`} },
            { path: 'create', component: require('./components/admin/role/Role.vue').default, meta: {breadcrumb: `役割を作成`} },
            { path: 'edit/:id', component: require('./components/admin/role/Role.vue').default, meta: {breadcrumb: `役割を編集`} },
        ]
    },

    {
        path: '/admin/page',
        component: {template: '<router-view/>'},
        meta: {breadcrumb: `ページ管理`},
        children: [
            { path: '', component: require('./components/admin/page/Index.vue').default, meta: {breadcrumb: `ページ一覧`} },
            { path: 'create', component: require('./components/admin/page/Page.vue').default, meta: {breadcrumb: `新規ページ作成`} },
            { path: 'edit/:id', component: require('./components/admin/page/Page.vue').default, meta: {breadcrumb: `ページ編集`} },
        ]
    },
];
