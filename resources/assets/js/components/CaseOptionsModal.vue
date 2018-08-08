<template>
  	<!-- Modal Component -->
	<b-modal id="case-options-modal" title="Optionen">
		<form @submit.prevent="onSubmit" class="form-inline px-md-5" autocomplete="off">
		    <input type="checkbox" class="form-check-input" id="case-modal-anonymous" v-model="anonymous">

		    <label class="form-check-label" for="case-modal-anonymous">
		    	Your name should be visible to the mentors {{ anonymous }}
		    </label>
		</form>
	</b-modal>
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