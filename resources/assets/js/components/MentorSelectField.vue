<template>
	<div>
		<multiselect
	    	v-model.sync="value"
	    	@input="$emit('input', value)"
	    	:options="mentors"
	    	:multiple="true"
	    	:close-on-select="maxSelected == 1"
	    	:clear-on-select="false"
	    	:hide-selected="true"
	    	:preserve-search="true"
	    	:max="maxSelected"
	    	placeholder=""
	    	select-label=""
	    	:custom-label="concatenateNames"
	    	track-by="id"
	    	:block-keys="['Tab', 'Enter']">

	    	<template slot="tag" slot-scope="props">
				<span class="mentor-tag bg-color-primary-1 text-white">
		    		{{ props.option.first_name }} 
		    		{{ props.option.last_name }}
		    		<span class="tag-remove" @click="props.remove(props.option)">
		    			<i class="fas fa-times-circle"></i>
		    		</span>
		    	</span>
			</template>

			<template slot="noResult">
				{{ lang('messages.no_search_result') }}
			</template>

			<template slot="maxElements">
				<span v-if="maxSelected > 0">
					{{
						lang('messages.max_mentors_selected', {
							"mentors": maxSelected
						})
					}}					
				</span>
				<span v-else></span>
			</template>

		</multiselect>
	</div>
</template>

<script>
	
	export default {
		props: {
			mentors: {
				type: Array
			},
			selected: {
				type: Array,
				required: false,
				default () {
					return [];
				}
			},
			maxSelected: {
				type: Number,
				required: false,
				default() {
					return 0;
				}
			}
		},
		model: {
			prop: 'value',
			event: 'input'
		},
		data() {
			return {
				value: this.selected
			}
		},
		methods: {
			concatenateNames ({ first_name, last_name }) {
				return `${first_name} ${last_name}`
			}
		}
	};

</script>

<style>
	.mentor-tag {
		align-content: center;
		justify-content: center;
		display: inline-block;
		border-radius: 16px;
		height: 32px;
		line-height: 32px;
		padding: 0 15px;
		margin-bottom: 8px;
		margin-right: 8px;
		cursor: pointer;
	}
</style>