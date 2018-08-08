<template>
	<select :id="selectId" class="d-none" name="mentors[]" multiple>
	</select>
</template>

<script>
	
	export default {
		props: {
			selectId: {
				type: String
			},
			parentId: {
				type: String
			},
			mentors: {
				type: String
			}
		},
		data() {
			return {
				mentorObjects: JSON.parse(this.mentors)
			}
		},
		methods: {
		},
		mounted() {
			$(document).ready(() => {
				$('#' + this.parentId).dropdown({
					multipleMode: 'label',
					input: '<input type="text" maxLength="100" placeholder="Search">',
					data: this.mentorObjects,
					searchable: true,
				});
			})
		}
	};

</script>

<style>

</style>