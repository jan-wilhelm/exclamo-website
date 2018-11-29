<template>
	<div class="d-md-inline">
		<a href="#" v-b-modal.case-options-modal class="float-md-right ml-md-3 cta cta-secondary"  data-toggle="modal" data-target="#case-options-modal">
			{{ lang('messages.options') }}
		</a>
		<b-modal ref="modal" id="case-options-modal" title="Optionen">
			<form autocomplete="off" class="px-sm-5 px-1">
				<div class="form-group">
					<label for="case-title">
						{{ lang('messages.casetitle') }}
					</label>
					<input type="text" class="form-control" id="case-title" v-model.trim="caseData.title">
				</div>
				<div class="form-group">
					<label for="category-select">
						{{ lang('messages.category') }}
					</label>

					<select id="category-select" class="form-control" v-model="caseData.category">
						<option v-for="category in categories" :value="category">{{ category }}</option>
					</select>
				</div>
				<div class="form-group" v-if="useLocations">
					<label for="location-select">
						{{ lang('messages.location') }}
					</label>

					<select id="location-select" class="form-control" v-model="caseData.location_id">
						<option v-for="location in locations" :value="location.id">{{ location.name }}</option>
					</select>
				</div>
				<div class="form-group">
					<div id="case-modal-mentors-div">
						<label>
							{{ lang('messages.mentors') }}
						</label>

						<mentor-select-field
							:mentors='mentors'
							:selected='caseData.mentors'
							v-model="caseData.mentors"
							:max-selected="maximumMentors"
						/>
					</div>
				</div>
				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" id="case-modal-anonymous" v-model="caseData.anonymous">
					<label class="form-check-label" for="case-modal-anonymous">
							{{ lang('messages.case_is_anonymous') }}
					</label>
				</div>
				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" id="case-modal-solved" v-model="caseData.solved">
					<label class="form-check-label" for="case-modal-solved">
						{{ lang('messages.case_is_solved') }}
					</label>
				</div>
			</form>

			<template slot="modal-footer">
				<div class="form-inline button-div bordered white hover justify-content-center" @click="saveSettings">
					<a href="#" class="mx-3">
						{{ lang('messages.save') }}
					</a>
				</div>
			</template>
		</b-modal>
	</div>
</template>

<script>
	import ExclamoApi from '../api';

	export default {
		props: {
			initialData: Object,
			categories: Array,
			locations: Array,
			mentors: Array,
			maximumMentors: Number,
			useLocations: {
				type: Boolean,
				required: false,
				default () {
					return false
				}
			}
		},
		data() {
			return {
				caseData: this.initialData
			}
		},
		methods: {
			saveSettings() {
				let data = _.cloneDeep(this.caseData)
				data.mentors = data.mentors.map((mentor) => {
					return mentor.id
				})

				let reportedCase = new ExclamoApi.ReportedCase();
				reportedCase.edit(data, () => {
					console.log("RELOAD");
					this.closeModal();
					location.reload();
				},
				(error) => {
					console.log(error.response);
				});
			},
			closeModal() {
				this.$refs.modal.hide('header-close');
			}
		},
	};
</script>

<style scoped>
	form .form-group {
		margin-bottom: 2rem;
	}
	#case-options-modal form, #case-options-modal .modal-title {
	    padding-left: .25rem !important;
	}

	@media (min-width: 576px) {
		#case-options-modal form, #case-options-modal .modal-title {
			padding-left: 3rem !important;
		}
	}
</style>