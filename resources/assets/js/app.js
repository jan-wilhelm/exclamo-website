
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Multiselect from 'vue-multiselect';
import Datepicker from 'vuejs-datepicker';

window.lang = (string) => _.get(window.translations, string);

Vue.component('multiselect', Multiselect);
Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-messages-container', require('./components/ChatMessagesContainer.vue'));
Vue.component('chat-input-form', require('./components/ChatInputForm.vue'));
Vue.component('case-options-modal', require('./components/CaseOptionsModal.vue'));
Vue.component('mentor-select-field', require('./components/MentorSelectField.vue'));
Vue.component('report-case-form', require('./components/ReportCaseForm.vue'));

const app = new Vue({
    el: '#app',
    data () {
    	return {
	    };
    },
    components: {
    	Datepicker
    }
});