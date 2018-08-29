<template>
	<form @submit.prevent="submit" id="case-form" method="post" class="form" role="form" :action="formEndpoint">
		<div class="form-group">
			<label for="title">
				{{ lang('messages.casetitle') }}
			</label>
			<input
				type="text"
				class="form-control"
				id="title"
				name="title"
				:placeholder="lang('placeholders.casetitle')"
			/>
		</div>

		<div class="form-group">
			<label for="message">
				{{ lang('messages.casedescription') }}
			</label>
			<textarea class="form-control" id="message" name="message"></textarea>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="message">
					{{ lang('messages.mentors') }}
				</label>
				<select class="d-none" id="mentor-select" name="mentors[]"></select>
				<mentor-select-field
					:mentors="possibleMentors"
					v-model="selectedMentors"
					:max-selected="maximumMentors"
				/>
			</div>
			<div class="form-group col-md-6">
				<label for="category">
					{{ lang('messages.category') }}
				</label>

				<select id="category-select" class="form-control" name="category">
					<option v-for="category in possibleCategories" :value="category">{{ category }}</option>
				</select>
			</div>
		</div>
		<div class="form-row">
	        <div class="col-md-6" v-if="useDates">
	        	<div class="form-group">
	                <div class="input-group date" id="case-date-picker" data-target-input="nearest">
						<label for="date">
							{{ lang('messages.dateselect') }}
						</label>

						<div class="input-group">
		                    <datepicker
		                    	:monday-first="true"
		                    	:disabled-dates="{'from': new Date()}"
		                    	v-model="incidentDate"
		                    	class="form-control datetimepicker-input"
		                    	name="incident_date">
	                    	</datepicker>

		                    <div class="input-group-append">
		                        <div class="input-group-text">
		                        	<i class="fa fa-calendar"></i>
		                        </div>
		                    </div>
		                </div>
		            </div>
	        	</div>
            </div>
	        <div class="col-md-6" v-if="useLocations">
				<div class="form-group">
					<label for="location">
						{{ lang('messages.location') }}
					</label>

					<select id="location-select" class="form-control" name="location">
						<option v-for="location in possibleLocations" :value="location.id">{{ location.title }}</option>
					</select>
				</div>
            </div>
		</div>

		<div class="form-row">
			<div class="form-check justify-content-center align-self-center mx-auto">
				<input type="checkbox" class="form-check-input" id="anonymous" name="anonymous">
				<label class="form-check-label" for="anonymous">
					{{ lang('messages.case_should_be_anonymous') }}
				</label>
			</div>
		</div>

		<div class="form-group text-center justify-content-center mt-3">
			<button type="submit" class="btn btn-primary">
				<i class="far fa-check-circle"></i>
				{{ lang('messages.create_case_button') }}
			</button>
		</div>
	</form>
</template>

<script>
	import Datepicker from 'vuejs-datepicker';
	import ReportedCase from '../api';

	export default {
		components: {
			Datepicker
		},
		props: {
			formEndpoint: String,
			possibleMentors: Array,
			possibleLocations: Array,
			possibleCategories: Array,
			maximumMentors: Number,
        	useLocations: {
        		type: Boolean,
        		required: false,
        		default() {
        			return false
        		}
        	},
        	useDates: {
        		type: Boolean,
        		required: false,
        		default() {
        			return false
        		}
        	}
		},
		data() {
	        return {
	        	selectedMentors: [],
	        	incidentDate: null
	        }
		},
		methods: {
			submit() {
				let caseForm = document.getElementById('case-form');
				let formData = new FormData(caseForm);

				for (var i = 0; i < this.selectedMentors.length; i++) {
				    formData.append('mentors[]', this.selectedMentors[i].id);
				}
				
				formData.append('incident_date', this.incidentDate);

				ReportedCase.create(formData,
				(response)=> {
					window.location.href = window.Exclamo.url + '/cases/' + response.data.id
				},
				(error)=> {
					console.log(error.response);
				})
			}
		}
	};
</script>

<style scoped>

</style>