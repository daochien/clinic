export default [
    { path: '/admin/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/admin/profile', component: require('./components/admin/Profile.vue').default },

    { path: '/admin/clinics', component: require('./components/admin/clinic/Index.vue').default, name: 'clinic_list' },
    { path: '/admin/clinic/:id/user', component: require('./components/admin/clinic/Users.vue').default, name: 'clinic_user' },
    { path: '/admin/clinic/edit/:id', component: require('./components/admin/clinic/Edit.vue').default, name: 'clinic_edit'},
    { path: '/admin/clinic/create', component: require('./components/admin/clinic/Create.vue').default, name: 'clinic_create'},

    { path: '/admin/users', component: require('./components/admin/Users.vue').default },

    { path: '/admin/products', component: require('./components/admin/product/Products.vue').default },
    { path: '/admin/product/tag', component: require('./components/admin/product/Tag.vue').default },
    { path: '/admin/product/category', component: require('./components/admin/product/Category.vue').default },

    { path: '*', component: require('./components/NotFound.vue').default },
];
