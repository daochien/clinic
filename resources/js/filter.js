import Vue from 'vue';

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

Vue.filter('limitString', limitString);