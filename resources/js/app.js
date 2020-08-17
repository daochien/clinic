require('./library/bootstrap');
require('./library/Chart.min');
require('./library/shards-dashboards.1.3.1.min');
require('./library/jquery.sharrre.min')
require('./library/extras.1.3.1.min')
require('./helpers/DateHelper')

window.Vue = require('vue');

import Vuex from 'vuex'
import VueMoment from 'vue-moment'
import moment from 'moment';
import auth from './auth';
import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';
import { Form, HasError, AlertError } from 'vform';
import Gate from "./Gate";
import Swal from 'sweetalert2';
import VueProgressBar from 'vue-progressbar'
import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(Vuex)
Vue.use(VueMoment, { moment })
Vue.use(VueRouter);
Vue.use(VueInternationalization);
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
});

const i18n = new VueInternationalization({
    locale: document.head.querySelector('meta[name="locale"]').content,
    messages: Locale
});
export default new Vuex.Store({
    modules: {
        auth
    }
})

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
const router = new VueRouter({
    mode: 'history',
    routes
});

/**
 * import Vuelidate form
*/
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);
window.Swal = Swal;
window.Toast = Toast;
window.Form = Form;

Vue.prototype.$gate = new Gate(window.user);

// Components
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('admin-dashboard', require('./components/admin/Dashboard.vue'));

Vue.component(
    'not-found',
    require('./components/NotFound.vue').default
);

// Filter Section
Vue.filter('myDate',function(created){
    if (created) {
        return moment(created).format('YYYY-MM-DD HH:mm:ss');
    }
    return "-";
});
Vue.filter('yesno', value => (value ? '<i class="fas fa-check green"></i>' : '<i class="fas fa-times red"></i>'));

const app = new Vue({
    el: '#app',
    i18n,
    router
});
