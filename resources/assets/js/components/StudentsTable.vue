<template>
	<b-container fluid class="text-left">
	<!-- User Interface controls -->
		<b-row>
			<div class="my-1 d-flex mr-auto">
				<b-form-group horizontal label="Filter" class="mb-0">
					<b-input-group>
						<b-form-input v-model="filter" :placeholder="lang('messages.type_to_search')" />
							<b-input-group-append>
							<b-btn :disabled="!filter" @click="filter = ''">
								{{ lang('messages.clear') }}
							</b-btn>
						</b-input-group-append>
					</b-input-group>
				</b-form-group>
			</div>
			<div class="my-1 d-flex flex-row">
				<div class="form-inline form-group horizontal">
					<label class="form-control-label mr-5">
						{{ lang('messages.per_page') }}
					</label>
					<b-form-select :options="pageOptions" v-model="perPage" />
				</div>
			</div>
		</b-row>

		<!-- Main table element -->
		<b-table show-empty
			stacked="md"
			:items="students"
			:current-page="currentPage"
			:per-page="perPage"
			:filter="filter"
			:fields="fields"
			@filtered="onFiltered"
		/>

		<b-row>
			<b-col md="6" class="my-1">
				<b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
			</b-col>
		</b-row>

	</b-container>
</template>

<script>
	export default {
		props: {
			students: Array
		},
		data () {
			return {
				currentPage: 1,
				perPage: 15,
				totalRows: this.students.length,
				pageOptions: [ 15, 50, 200 ],
				filter: null,
				fields: [
					{
						key: 'id',
						label: Vue.prototype.lang('messages.id'),
						sortable: true
					},
					{
						key: 'first_name',
						label: Vue.prototype.lang('messages.first_name'),
						sortable: true
					},
					{
						key: 'last_name',
						label: Vue.prototype.lang('messages.last_name'),
						sortable: true
					},
					{
						key: 'email',
						label: Vue.prototype.lang('messages.email'),
						sortable: true
					},
					{
						key: 'mentoring',
						label: Vue.prototype.lang('messages.mentoring'),
						sortable: true,
						formatter: (value) => {
							return value ? "Ja" : "Nein"
						}
					},
				],
			}
		},
		computed: {
		},
		methods: {
			onFiltered (filteredItems) {
				// Trigger pagination to update the number of buttons/pages due to filtering
				this.totalRows = filteredItems.length
				this.currentPage = 1
			}
		}
	}
</script>