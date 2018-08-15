
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Multiselect from 'vue-multiselect';

Vue.component('multiselect', Multiselect)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-messages-container', require('./components/ChatMessagesContainer.vue'));
Vue.component('chat-input-form', require('./components/ChatInputForm.vue'));
Vue.component('case-options-modal', require('./components/CaseOptionsModal.vue'));
Vue.component('mentor-select-field', require('./components/MentorSelectField.vue'));
//Vue.component('case-messages-container', require('./components/CaseMessagesContainer.vue'));

const app = new Vue({
    el: '#app',
    data: {
    },
    mounted() {
    	console.log(this.$refs);
    }
});