<template>
	<div class="d-inline">
		<a href="#" v-b-modal.case-options-modal class="float-md-right ml-3 cta cta-secondary"  data-toggle="modal" data-target="#case-options-modal">
			Optionen
		</a>
		<b-modal ref="modal" id="case-options-modal" title="Optionen">
			<form autocomplete="off" class="px-sm-5 px-1">
				<div class="form-group">
					<label for="case-title">Titel</label>
					<input type="text" class="form-control" id="case-title" v-model.trim="caseData.title">
				</div>
				<div class="form-group">
					<label for="category-select">
						Category
					</label>

					<select id="category-select" class="form-control" v-model="caseData.category">
						<option v-for="category in categories" :value="category">{{ category }}</option>
					</select>
				</div>
				<div class="form-group">
					<label for="location-select">
						Location
					</label>

					<select id="location-select" class="form-control" v-model="caseData.location_id">
						<option v-for="location in locations" :value="location.id">{{ location.name }}</option>
					</select>
				</div>
				<div class="form-group">
					<div id="case-modal-mentors-div">
						<label>
							Mentors
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
						Your name should be visible to the mentors
					</label>
				</div>
				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" id="case-modal-solved" v-model="caseData.solved">
					<label class="form-check-label" for="case-modal-solved">
						This case is solved
					</label>
				</div>
			</form>

			<template slot="modal-footer">
				<div class="form-inline button-div bordered white hover justify-content-center" @click="saveSettings">
					<a href="#" class="mx-3">Save</a>
				</div>
			</template>
		</b-modal>
	</div>
</template>

<script>
	import ReportedCase from '../api';

	export default {
		props: {
			initialData: Object,
			categories: Array,
			locations: Array,
			mentors: Array,
			maximumMentors: Number
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

				let reportedCase = new ReportedCase();
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
</style>
<style>
	

	#case-options-modal form, #case-options-modal .modal-title {
	    padding-left: .25rem !important;
	}

	@media (min-width: 576px) {
		#case-options-modal form, #case-options-modal .modal-title {
			padding-left: 3rem !important;
		}
	}
</style>