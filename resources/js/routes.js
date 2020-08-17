export default [
    { path: '/admin/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/admin/profile', component: require('./components/admin/Profile.vue').default },

    { path: '/admin/clinics', component: require('./components/admin/clinic/Index.vue').default, name: 'clinic.list' },
    { path: '/admin/clinic/:id/edit', component: require('./components/admin/clinic/Edit.vue').default, name: 'clinic.edit'},
    { path: '/admin/clinic/create', component: require('./components/admin/clinic/Create.vue').default, name: 'clinic.create'},
    { path: '/admin/clinic/:id/user', component: require('./components/admin/clinic/Users.vue').default, name: 'clinic.user' },
    { path: '/admin/clinic/:id/add-user', component: require('./components/admin/clinic/AddUsers.vue').default, name: 'clinic.add.user' },

    { path: '/admin/users', component: require('./components/admin/user/Index.vue').default, name: 'user.list' },
    { path: '/admin/user/create', component: require('./components/admin/user/Create.vue').default, name: 'user.create' },
    { path: '/admin/user/:id/edit', component: require('./components/admin/user/Edit.vue').default, name: 'user.edit' },

    { path: '/admin/products', component: require('./components/admin/product/Products.vue').default },
    { path: '/admin/product/tag', component: require('./components/admin/product/Tag.vue').default },
    { path: '/admin/product/category', component: require('./components/admin/product/Category.vue').default },
    { path: '/admin/blog/create', component: require('./components/admin/blog/Create.vue').default },
    { path: '/admin/managers', component: require('./components/admin/manager/Managers.vue').default },
    { path: '/admin/manager/create', component: require('./components/admin/manager/Manager.vue').default },
    { path: '/admin/manager/edit/:id(\\d+)', component: require('./components/admin/manager/Manager.vue').default },
    { path: '/admin/roles', component: require('./components/admin/role/Roles.vue').default },
    { path: '/admin/role/create', component: require('./components/admin/role/Role.vue').default },
    { path: '/admin/role/edit/:id', component: require('./components/admin/role/Role.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
];
