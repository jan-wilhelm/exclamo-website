<template>
	<b-container fluid class="text-left">
	<!-- User Interface controls -->
		<div class="d-flex">
			<div class="my-1 d-flex mr-auto">
				<div class="form-inline form-group horizontal">
					<label class="form-control-label mr-2">
						Filter
					</label>
					<b-input-group>
						<b-form-input v-model="filter" :placeholder="lang('messages.type_to_search')" />
						<b-input-group-append>
							<button @click="filter = ''" type="button" class="cta cta-secondary cta-form-group nr-l">
								{{ lang('messages.clear') }}
							</button>
						</b-input-group-append>
					</b-input-group>
				</div>
			</div>
			<div class="my-1 d-flex flex-row">
				<div class="form-inline form-group horizontal">
					<label class="form-control-label mr-2">
						{{ lang('messages.per_page') }}
					</label>
					<b-form-select :options="pageOptions" v-model="perPage" />
				</div>
			</div>
		</div>

		<students-options-modal ref="editModal" />

		<!-- Main table element -->
		<b-table show-empty
			stacked="md"
			:items="items"
			:current-page="currentPage"
			:per-page="perPage"
			:filter="filter"
			:fields="fields"
			striped
			bordered
			@filtered="onFiltered"
			ref="students-table"
		>
		    <template slot='mentoring' slot-scope='row'>
				<span class="text-center w-100 d-inline-block" v-html='formatters["mentoring"](row.value)'></span>
		    </template>
			<template slot="actions" slot-scope="data">
				<div class="text-center">
					<b-dropdown id="ddown1" variant="link" no-caret class="actions-button">
						<template slot="button-content" class="text-center">
							<i class="fas fa-ellipsis-v secondary-color"></i>
						</template>
					    <b-dropdown-item @click="openEditModal(data)">Edit</b-dropdown-item>
					    <b-dropdown-divider></b-dropdown-divider>
					    <b-dropdown-item @click="deleteStudent(data)">
				    		<i class="color-secondary-1-0 mr-3 fas fa-trash-alt"></i>
				    		<span>Delete</span>
				    	</b-dropdown-item>
					</b-dropdown>
				</div>
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
	import ExclamoApi from '../api';

	export default {
		props: {
			students: Array
		},
		data () {
			return {
				items: this.students,
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
						label: Vue.prototype.lang('messages.actions')
					}
				],
				formatters: {
					'mentoring': function(data) {
				    	return '<i class="text-right fas ' + (data ? 'fa-check' : 'fa-times') + '"></i>'
					}
				}
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
			openEditModal(data) {
				let student = data.item
				this.$refs.editModal.student = student
				this.$refs.editModal.showModal()
			},
			deleteStudent(data) {
				let studentId = data.item.id
				let studentsTable = this
				ExclamoApi.User.delete(studentId)
					.then(function(response) {
						studentsTable.items = studentsTable.items.filter(function( student ) {
						    return student.id !== studentId
						});
						console.log(response)
					}).catch(function(error) {
						console.log(error);
	    				console.log(error.response)
					})
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