<template>
	<div class="d-inline">
		<b-btn v-b-modal.case-options-modal variant="secondary" class="form-inline button-div bordered white hover mt-md-0 mt-3 float-md-right justify-content-center">
			<a href="#" class="mx-3"  data-toggle="modal" data-target="#case-options-modal">
				Optionen
			</a>
		</b-btn>
		<b-modal ref="modal" id="case-options-modal" title="Optionen">
			<form autocomplete="off">
				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" id="case-modal-anonymous" v-model="caseData.anonymous">
					<label class="form-check-label" for="case-modal-anonymous">
						Your name should be visible to the mentors
					</label>
				</div>
				<div class="form-group">
					<div id="case-modal-mentors-div">
						<label>
							Mentors
						</label>

						<mentor-select-field :mentors='mentors' :selected='selectedMentors' />
					</div>
				</div>
				<div class="form-group">
					<label for="category-select">
						Category
					</label>

					<select id="category-select" class="form-control" ref="categorySelect">
						<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
					</select>
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
			initialData: {
				type: Object
			},
			categories: {
				type: Array
			},
			selectedCategory: {
				type: Number
			},
			mentors: {
				type: Array
			},
			selectedMentors: {
				type: Array
			}
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
			selectItemByValue(element, value) {
				for(var i=0; i < element.options.length; i++) {
					if (element.options[i].value == value) {
						element.selectedIndex = i;
						element.options[i].setAttribute("selected", true);
						return element[i]
					}
				}
			}
		},
		mounted() {
			this.selectItemByValue(this.$refs.categorySelect, this.selectedCategory);
		}
	};
</script>

<style>

</style>