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
const dateTimeFormats = {
    'en': {
        long: {
            year: 'numeric', month: 'short', day: 'numeric',
            hour: 'numeric', minute: 'numeric'
        },
        short: {
            year: 'numeric', month: 'short', day: 'numeric'
        }
    },
    'ja': {
        long: {
            year: 'numeric', month: 'short', day: 'numeric',
            hour: 'numeric', minute: 'numeric'
        },
        short: {
            year: 'numeric', month: 'short', day: 'numeric'
        }
    }
}

const i18n = new VueInternationalization({
    locale: document.head.querySelector('meta[name="locale"]').content,
    messages: Locale,
    dateTimeFormats
});

import { Form, HasError, AlertError } from 'vform';
window.Form = Form;

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);

import Swal from 'sweetalert2';
const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000,
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
Vue.use(require('vue-moment'));

/**
 * Routes imports and assigning
 */
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import routes from './routes';

const router = new VueRouter({
    mode: 'history',
    routes,
    linkActiveClass: "link-active"
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

Vue.component('not-found', require('./components/NotFound.vue').default);
Vue.component('my-account', require('./components/client/MyAccount').default);

import Vue2Editor from "vue2-editor";
Vue.use(Vue2Editor);

// Filter Section

Vue.filter('myDate', function (created) {
    if (created) {
        return i18n.d(new Date(created), 'long', i18n.locale);
        // return moment(created).format('YYYY-MM-DD HH:mm:ss');
    }
    return "-";
});

Vue.filter('myDateShort', function (created) {
    if (created) {
        return i18n.d(new Date(created), 'short', i18n.locale);
    }
    return "-";
});

Vue.filter('formatAttachFile', function (fileName) {
    let props = _.split(fileName,'_____', 2);
    return props[1];
})

Vue.filter('yesno', value => (value ? '<i class="fas fa-check green"></i>' : '<i class="fas fa-times red"></i>'));

// end Filter

Vue.mixin({
    methods: {
        subIsActive(input) {
            const paths = Array.isArray(input) ? input : [input]
            return paths.some(path => {
                console.log(this.$route.path.indexOf(path) === 0)
                return this.$route.path.indexOf(path) !== 0 // current path starts with this path string
            })
        }
    }
})

const app = new Vue({
    el: '#app',
    i18n,
    router
});
