<template>
	<b-modal
		ref="modal"
		id="students-options-modal"
		:title="lang('messages.create_student')"
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

		    <b-form-select v-model="student.role" :options="roles" class="form-group">
		    </b-form-select>
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
				},
				roles: [
					"Schüler",
					"Lehrer"
				]
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

			}
		},
	};
</script>