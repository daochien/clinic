export default [
    { path: '/admin/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/admin/profile', component: require('./components/admin/Profile.vue').default },
    { path: '/admin/users', component: require('./components/admin/Users.vue').default },
    { path: '/admin/products', component: require('./components/admin/product/Products.vue').default },
    { path: '/admin/product/tag', component: require('./components/admin/product/Tag.vue').default },
    { path: '/admin/product/category', component: require('./components/admin/product/Category.vue').default },
    { path: '/admin/blog/create', component: require('./components/admin/blog/Create.vue').default },
    { path: '/admin/managers', component: require('./components/admin/manager/Managers.vue').default },
    { path: '/admin/manager/create', component: require('./components/admin/manager/Manager.vue').default },
    { path: '/admin/manager/edit/:id(\\d+)', component: require('./components/admin/manager/Manager.vue').default },
    { path: '/admin/permissions', component: require('./components/admin/permission/Permissions.vue').default },
    { path: '/admin/roles', component: require('./components/admin/role/Roles.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
];
