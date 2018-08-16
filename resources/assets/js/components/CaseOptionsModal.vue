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
					<input type="checkbox" class="form-check-input" id="case-modal-anonymous" v-model="anonymous">
					<label class="form-check-label" for="case-modal-anonymous">
						Your name should be visible to the mentors
					</label>
				</div>
				<div class="form-group">
					<div id="case-modal-mentors-div">
						<label>
							Mentors
						</label>

						<mentor-select-field :mentors='[{"id":30,"name":"Corrine Schumm"},{"id":33,"name":"Hanna Kertzmann"},{"id":34,"name":"Aiden Denesik"},{"id":36,"name":"Summer DuBuque"},{"id":40,"name":"Uriah Kub"}]' :selected='[{"id":30,"name":"Corrine Schumm"},{"id":33,"name":"Hanna Kertzmann"}]' />
					</div>
				</div>
			</form>

			<template slot="modal-footer">
				<div class="form-inline button-div bordered white hover justify-content-center" @click="closeModal">
					<a href="#" class="mx-3">Save</a>
				</div>
			</template>
		</b-modal>
	</div>
</template>

<script>
	export default {
		props: {
			caseData: {
				type: String
			}
		},
		data() {
			return {
				anonymous: JSON.parse(this.caseData).anonymous,
				mentors: JSON.parse(this.caseData).mentors
			}
		},
		methods: {
			onSubmit() {
			},
			closeModal() {
				this.$refs.modal.hide('header-close')
			}
		}
	};
</script>

<style>

</style>