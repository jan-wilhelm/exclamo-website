<template>
	<table class="table text-left">
		<thead>
			<tr>
				<th>{{ lang('messages.id') }}</th>
				<th>{{ lang('messages.first_name') }}</th>
				<th>{{ lang('messages.last_name') }}</th>
				<th>{{ lang('messages.email') }}</th>
				<th>{{ lang('messages.mentoring') }}</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="student in students">
				<td>{{ student.id }}</td>
				<td>{{ student.first_name }}</td>
				<td>{{ student.last_name }}</td>
				<td>{{ student.email }}</td>
				<td>
					<i v-if="student.mentoring" class="fas fa-check"></i>
					<i v-else class="fas fa-times"></i>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	export default {
		props: {
			students: Array
		},
		data() {
			return {
			}
		}
	};
</script>

<style>

</style>