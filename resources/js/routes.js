export default [
    { path: '/admin/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/admin/profile', component: require('./components/admin/Profile.vue').default },

    {
        path: '/admin/clinic',
        component: require('./components/admin/clinic/Index.vue').default,
        name: 'clinic.list',
        meta: {
            breadCrumb: 'Clinic'
        },
        children: [
            {
                path: '/admin/clinic/:id/edit',
                component: require('./components/admin/clinic/Edit.vue').default,
                name: 'clinic.edit',
                meta: {
                    breadCrumb: 'Edit'
                }
            },
            {
                path: 'create',
                component: require('./components/admin/clinic/Create.vue').default,
                name: 'clinic.create',
                meta: {
                    breadCrumb: 'Create'
                }
            },
        ]
    },

    // { path: '/admin/clinics', component: require('./components/admin/clinic/Index.vue').default, name: 'clinic.list' },
    // { path: '/admin/clinic/:id/edit', component: require('./components/admin/clinic/Edit.vue').default, name: 'clinic.edit'},
    // { path: '/admin/clinic/create', component: require('./components/admin/clinic/Create.vue').default, name: 'clinic.create'},
    { path: '/admin/clinic/:id/user', component: require('./components/admin/clinic/Users.vue').default, name: 'clinic.user' },
    { path: '/admin/clinic/:id/add-user', component: require('./components/admin/clinic/AddUsers.vue').default, name: 'clinic.add.user' },

    { path: '/admin/users', component: require('./components/admin/user/Index.vue').default, name: 'user.list' },
    { path: '/admin/user/create', component: require('./components/admin/user/Create.vue').default, name: 'user.create' },
    { path: '/admin/user/:id/edit', component: require('./components/admin/user/Edit.vue').default, name: 'user.edit' },

    { path: '/admin/templates', component: require('./components/admin/template/Index.vue').default },
    { path: '/admin/templates/create', component: require('./components/admin/template/Create.vue').default },

    { path: '/admin/products', component: require('./components/admin/product/Products.vue').default },
    { path: '/admin/product/tag', component: require('./components/admin/product/Tag.vue').default },
    { path: '/admin/product/category', component: require('./components/admin/product/Category.vue').default },

    { path: '*', component: require('./components/NotFound.vue').default },

    { path: '/admin/notifications', component: require('./components/admin/notifications/Index.vue').default },
    { path: '/admin/notification/details', component: require('./components/admin/notifications/Details.vue').default, name: 'details_notification' },
    { path: '/admin/notification/edit', component: require('./components/admin/notifications/Edit.vue').default, name: 'edit_notification' },

    { path: '/admin/blog/create', component: require('./components/admin/blog/Create.vue').default },

    { path: '/admin/managers', component: require('./components/admin/manager/Managers.vue').default },
    { path: '/admin/manager/create', component: require('./components/admin/manager/Manager.vue').default },
    { path: '/admin/manager/edit/:id(\\d+)', component: require('./components/admin/manager/Manager.vue').default },
    { path: '/admin/roles', component: require('./components/admin/role/Roles.vue').default },

    { path: '/admin/group', component: require('./components/admin/group/Index.vue').default },
    { path: '/admin/group/add', component: require('./components/admin/group/Add.vue').default, name:'add_group' },
    { path: '/admin/group/edit', component: require('./components/admin/group/Edit.vue').default, name:'edit_group' },
    // { path: '/admin/group/users', component: require('./components/admin/group/Members.vue').default, name:'users_group' },

    { path: '/admin/role/create', component: require('./components/admin/role/Role.vue').default },
    { path: '/admin/role/edit/:id', component: require('./components/admin/role/Role.vue').default },
];
