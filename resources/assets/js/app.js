
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Multiselect from 'vue-multiselect';
import Datepicker from 'vuejs-datepicker';
import VueApexCharts from 'vue-apexcharts'

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

let functions = [
	input => {
		return input.toUpperCase()
	},
	input => {
		return input.capitalize()
	},
	input => {
		return input
	}
]

Vue.prototype.lang = (string, props = {}) => {
	let translation = _.get(window.translations, string);

	for (const key of Object.keys(props)) {
	    console.log("Prop", key, props[key]);

	    for (let functionName of functions) {
	    	let includedString = ':' + functionName(key)
	    	let formattedPlaceholder = functionName(String(props[key]))
			
			if (translation.includes(includedString)) {
	    		translation = translation.replace(includedString, formattedPlaceholder)
	    	}
	    }
	}

	if (translation === undefined) {
		return string
	}

	return translation
}

Vue.use(VueApexCharts);
Vue.component('multiselect', Multiselect);
Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-messages-container', require('./components/ChatMessagesContainer.vue'));
Vue.component('chat-input-form', require('./components/ChatInputForm.vue'));
Vue.component('case-options-modal', require('./components/CaseOptionsModal.vue'));
Vue.component('mentor-select-field', require('./components/MentorSelectField.vue'));
Vue.component('report-case-form', require('./components/ReportCaseForm.vue'));
Vue.component('students-table', require('./components/StudentsTable.vue'));
Vue.component('students-options-modal', require('./components/StudentsOptionsModal.vue'));

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