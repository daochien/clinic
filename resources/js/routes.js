export default [
    { path: '/admin/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/admin/profile', component: require('./components/admin/Profile.vue').default },
    { path: '/admin/users', component: require('./components/admin/Users.vue').default },
    { path: '/admin/products', component: require('./components/admin/product/Products.vue').default },
    { path: '/admin/product/tag', component: require('./components/admin/product/Tag.vue').default },
    { path: '/admin/product/category', component: require('./components/admin/product/Category.vue').default },

    { path: '*', component: require('./components/NotFound.vue').default },
    { path: '/admin/group', component: require('./components/admin/group/Index.vue').default },
    { path: '/admin/group/add', component: require('./components/admin/group/Add.vue').default, name:'add_group' },
    { path: '/admin/group/edit', component: require('./components/admin/group/Edit.vue').default, name:'edit_group' },
    { path: '/admin/group/users', component: require('./components/admin/group/Members.vue').default, name:'users_group' }
];
