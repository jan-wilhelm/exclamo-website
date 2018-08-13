<template>
	<div class="modal fade" id="case-options-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Options</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="px-md-5" autocomplete="off">
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

								<mentor-select-field :mentors='[{"id":30,"name":"Corrine Schumm"},{"id":33,"name":"Hanna Kertzmann"},{"id":34,"name":"Aiden Denesik"},{"id":36,"name":"Summer DuBuque"},{"id":40,"name":"Uriah Kub"}]' selectId="case-modal-mentors" parentId="case-modal-mentors-div"> </mentor-select-field>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<div class="form-inline button-div bordered white hover justify-content-center">
						<a href="#" class="mx-3">Save</a>
					</div>
				</div>
			</div>
	  </div>
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

			}
		}
	};
</script>

<style>

</style>