import Vue from 'vue';
import moment from 'moment';

function limitString(value) {

    if (value) {
        if(value.length < 30) {
            return value;
        } else {
            return value.substring(0, 30) + '...';
        }
    } else {
        return '-';
    }
}

function limitString20(value) {

    if (value) {
        if(value.length < 20) {
            return value;
        } else {
            return value.substring(0, 20) + '...';
        }
    } else {
        return '-';
    }
}

function dateFormat(date) {
    return moment(date).format('d/m/Y');
}

Vue.filter('limitString', limitString);
Vue.filter('limitString20', limitString20);
Vue.filter('dateFormat', dateFormat);

