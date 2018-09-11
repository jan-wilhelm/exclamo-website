<template>
	<b-container fluid class="text-left">
	<!-- User Interface controls -->
		<b-row>
			<div class="my-1 d-flex mr-auto">
				<b-form-group horizontal label="Filter" class="mb-0">
					<b-input-group>
						<b-form-input v-model="filter" :placeholder="lang('messages.type_to_search')" />
							<b-input-group-append>
							<button @click="filter = ''" type="button" class="cta cta-secondary cta-form-group nr-l">
								{{ lang('messages.clear') }}
							</button>
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
			striped
			bordered
			@filtered="onFiltered"
		>
		    <template v-for='field in formatted' :slot='field' slot-scope='row'>
				<span class="text-left w-100 d-inline-block" v-html='formatter(row.value)'></span>
		    </template>
			<template slot="actions" slot-scope="row">
				<b-dropdown id="ddown1" variant="link" no-caret class="actions-button">
					<template slot="button-content">
						<i class="fas fa-ellipsis-v"></i>
					</template>
				    <b-dropdown-item>First Action</b-dropdown-item>
				    <b-dropdown-item>Second Action</b-dropdown-item>
				    <b-dropdown-item>Third Action</b-dropdown-item>
				    <b-dropdown-divider></b-dropdown-divider>
				    <b-dropdown-item>Something else here...</b-dropdown-item>
				  </b-dropdown>
			</template>
		</b-table>

		<b-row class="d-flex justify-content-center">
			<b-col class="my-1">
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
						sortable: true
					},
					{
						key: 'actions',
						label: Vue.prototype.lang('messages.actions'),
					}
				],
				formatted: ['mentoring']
			}
		},
		computed: {
		},
		methods: {
			onFiltered (filteredItems) {
				// Trigger pagination to update the number of buttons/pages due to filtering
				this.totalRows = filteredItems.length
				this.currentPage = 1
			},
		    formatter: function(data) {
		    	return '<i class="text-right fas ' + (data ? 'fa-check' : 'fa-times') + '"></i>'
		    }
		}
	}
</script>

<style>
	.actions-button button {
		padding-top: 0;
		padding-bottom: 0;
	}
</style>