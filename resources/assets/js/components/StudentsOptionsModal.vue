<template>
	<b-modal
		ref="modal"
		id="students-options-modal"
		:title="lang('messages.edit_student_data', {
			'first_name': student.first_name,
			'last_name': student.last_name
		})"
	>
		<form autocomplete="off">
			<div class="form-row mb-3">
				<div class="col-lg mb-3">
					<label for="student-firstname">
						{{ lang('messages.first_name') }}
					</label>
					<input type="text" class="form-control" id="student-firstname" v-model.trim="student.first_name">
				</div>
				<div class="col-md">
					<label for="student-lastname">
						{{ lang('messages.last_name') }}
					</label>
					<input type="text" class="form-control" id="student-lastname" v-model.trim="student.last_name">
				</div>
			</div>
			<div class="form-group">
				<label for="student-email">
					{{ lang('messages.email') }}
				</label>
				<input type="text" class="form-control" id="student-email" v-model.trim="student.email">
			</div>
			<div class="form-group form-check">
				<input type="checkbox" class="form-check-input" id="student-mentoring" v-model="student.mentoring">
				<label class="form-check-label" for="student-mentoring">
					{{ lang('messages.mentoring') }}
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
</template>

<script>
	import ExclamoApi from '../api';

	export default {
		props: {
		},
		data() {
			return {
				student: {

				}
			}
		},
		methods: {
			closeModal() {
				this.$refs.modal.hide('header-close')
			},
			showModal() {
				this.$refs.modal.show()
			},
			saveSettings() {
				let studentsModal = this
				ExclamoApi.User.edit(this.student.id, this.student)
					.then(function(response) {
						console.log(response)
						studentsModal.closeModal()
					}).catch(function(error) {
						console.log(error);
	    				console.log(error.response)
					})
			}
		},
	};
</script>