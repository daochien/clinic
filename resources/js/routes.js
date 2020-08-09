export default [
    { path: '/admin/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/admin/profile', component: require('./components/admin/Profile.vue').default },
    { path: '/admin/users', component: require('./components/admin/Users.vue').default },
    { path: '/admin/products', component: require('./components/admin/product/Products.vue').default },
    { path: '/admin/product/tag', component: require('./components/admin/product/Tag.vue').default },
    { path: '/admin/product/category', component: require('./components/admin/product/Category.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default },
    { path: '/admin/notifications', component: require('./components/admin/notifications/Index.vue').default },
    { path: '/admin/notification/details', component: require('./components/admin/notifications/Details.vue').default, name: 'details_notification' },
    { path: '/admin/notification/edit', component: require('./components/admin/notifications/Edit.vue').default, name: 'edit_notification' },
];
