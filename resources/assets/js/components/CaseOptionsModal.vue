<template>
	<div class="d-inline">
		<b-btn v-b-modal.case-options-modal variant="secondary" class="form-inline button-div bordered white hover mt-md-0 mt-3 float-md-right justify-content-center">
			<a href="#" class="mx-3"  data-toggle="modal" data-target="#case-options-modal">
				Optionen
			</a>
		</b-btn>
		<b-modal ref="modal" id="case-options-modal" title="Optionen">
			<form autocomplete="off">
				<div class="form-group">
					<label for="case-title">Titel</label>
					<input type="text" class="form-control" id="case-title" v-model.trim="caseData.title">
				</div>
				<div class="form-group">
					<label for="category-select">
						Category
					</label>

					<select id="category-select" class="form-control" v-model="caseData.category">
						<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
					</select>
				</div>
				<div class="form-group">
					<label for="location-select">
						Location
					</label>

					<select id="location-select" class="form-control" v-model="caseData.location">
						<option v-for="location in locations" :value="location.id">{{ location.name }}</option>
					</select>
				</div>
				<div class="form-group">
					<div id="case-modal-mentors-div">
						<label>
							Mentors
						</label>

						<mentor-select-field :mentors='mentors' :selected='caseData.mentors' v-model="caseData.mentors" />
					</div>
				</div>
				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" id="case-modal-anonymous" v-model="caseData.anonymous">
					<label class="form-check-label" for="case-modal-anonymous">
						Your name should be visible to the mentors
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
	import '../api';

	export default {
		props: {
			initialData: Object,
			categories: Array,
			locations: Array,
			mentors: Array
		},
		data() {
			return {
				caseData: this.initialData
			}
		},
		methods: {
			saveSettings() {
				this.$refs.modal.hide('header-close');
			},
		},
	};
</script>

<style>

</style>