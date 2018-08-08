<template>
  	<!-- Modal Component -->
	<b-modal id="case-options-modal" title="Optionen">
		<form @submit.prevent="onSubmit" class="form-inline px-md-5" autocomplete="off">
		    <input type="checkbox" class="form-check-input" id="case-modal-anonymous">
		    <label class="form-check-label" for="case-modal-anonymous">
		    	Your name should be visible to the mentors
		    </label>
		</form>
	</b-modal>
</template>

<script>
	
	export default {
		data() {
			return {

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