window.Vue = require('vue');
window.BootstrapVue = require('bootstrap-vue');
require('vue-multiselect');

window.Vue.use(window.BootstrapVue);
window.AOS = require('aos');

const app = new Vue({
    el: '#app',
    data () {
    	return {
	    };
    }
});
AOS.init({
	duration: 1200,
	once: true
});