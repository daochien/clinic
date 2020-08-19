import Vue from 'vue'

Date.prototype.convert = function(format = 'YYYY-MM-DD HH:mm:ss') {
    if (this.valueOf()) {
        let date = new Date(this.valueOf());
        return Vue.moment(date).format(format);
    } else {
        return '-'
    }
};

