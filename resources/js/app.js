/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./library/bootstrap');
require('./library/Chart.min');
require('./library/shards-dashboards.1.3.1.min');
require('./library/jquery.sharrre.min')
require('./library/extras.1.3.1.min')

window.Vue = require('vue');
import Vuex from 'vuex'
import moment from 'moment';
import auth from './auth'

Vue.use(Vuex)
export default new Vuex.Store({
    modules: {
        auth
    }
})

import VueBreadcrumbs from 'vue-2-breadcrumbs';
Vue.use(VueBreadcrumbs);

import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';

Vue.use(VueInternationalization);
const i18n = new VueInternationalization({
    locale: document.head.querySelector('meta[name="locale"]').content,
    messages: Locale
});

import { Form, HasError, AlertError } from 'vform';
window.Form = Form;

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);

import Swal from 'sweetalert2';


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Swal = Swal;
window.Toast = Toast;

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
});

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

/**
 * Routes imports and assigning
 */
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import routes from './routes';

const router = new VueRouter({
    mode: 'history',
    routes
});
// Routes End

/**
 * import Vuelidate form
*/
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

/**
 * import Vue filter
*/
import filter from './filter';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


// Components
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('admin-dashboard', require('./components/admin/Dashboard.vue'));

Vue.component(
    'not-found',
    require('./components/NotFound.vue').default
);

// Filter Section

Vue.filter('myDate', function (created) {
    if (created) {
        return moment(created).format('YYYY-MM-DD HH:mm:ss');
    }
    return "-";
});

Vue.filter('yesno', value => (value ? '<i class="fas fa-check green"></i>' : '<i class="fas fa-times red"></i>'));

// end Filter


const app = new Vue({
    el: '#app',
    i18n,
    router
});
