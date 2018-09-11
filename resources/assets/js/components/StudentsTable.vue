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
			<template v-for="editable in editableFields" :slot="editable" slot-scope="data">
				<div>
					<div v-if="editing[data.field.key].indexOf(items.indexOf(data.item)) == -1" class="d-flex w-100 flex-row justify-content-between">
						<span>{{ data.value }}</span>
						<div @click="edit(data)">
							<i class="opacity-hover pointer fas fa-pencil-alt"></i>
						</div>
					</div>
					<div v-else class="d-flex w-100 flex-row justify-content-between">
						<input type="text" class="form-control" :value="data.value" />
						<span class="d-flex flex-row vdivide align-items-center">
							<span @click="saveEdit(data)"><i class="pointer color-primary-0 mx-2 fas fa-lg fa-check-circle"></i></span>
							<span @click="saveEdit(data)"><i class="pointer color-secondary-1-0 fas fa-lg fa-times"></i></span>
						</span>
					</div>
				</div>
			</template>
		    <template slot='mentoring' slot-scope='row'>
				<span class="text-center w-100 d-inline-block" v-html='formatters["mentoring"](row.value)'></span>
		    </template>
			<template slot="actions" slot-scope="row">
				<div class="text-center">
					<b-dropdown id="ddown1" variant="link" no-caret class="actions-button">
						<template slot="button-content" class="text-center">
							<i class="fas fa-ellipsis-v secondary-color"></i>
						</template>
					    <b-dropdown-item>First Action</b-dropdown-item>
					    <b-dropdown-item>Second Action</b-dropdown-item>
					    <b-dropdown-item>Third Action</b-dropdown-item>
					    <b-dropdown-divider></b-dropdown-divider>
					    <b-dropdown-item>Something else here...</b-dropdown-item>
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
	export default {
		props: {
			students: Array
		},
		data () {
			return {
				editing: [],
				items: this.students,
				currentPage: 1,
				perPage: 15,
				totalRows: this.students.length,
				pageOptions: [ 15, 50, 200 ],
				filter: null,
				editableFields: ['first_name', 'last_name', 'id'],
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
		created() {
			this.fields.forEach((field) => {
				this.editing[field.key] = []
			});
		},
		methods: {
			onFiltered (filteredItems) {
				// Trigger pagination to update the number of buttons/pages due to filtering
				this.totalRows = filteredItems.length
				this.currentPage = 1
			},

			// This is a hacky way to rerender the data. TODO: Find a better, documented way
			// instead of firing the property watchers by changing the value and then changing it back
			refreshFilter() {
				let tempFilter = this.filter
				this.filter = ""

				if (tempFilter == null) {
					this.filter = null
				} else {
					this.filter = tempFilter
				}
			},
			edit (data) {
				let index = this.items.indexOf(data.item)
				this.editing[data.field.key].push(index)
				this.refreshFilter()
			},
			saveEdit(data) {
				this.editing[data.field.key].pop(data.item)
				this.refreshFilter()
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