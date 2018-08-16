<template>
  <div>
    <multiselect v-model="value" :options="mentors" select-label="" :multiple="true" :close-on-select="false" :clear-on-select="false" :hide-selected="true" :preserve-search="true" placeholder="" label="name" track-by="id" :block-keys="['Tab', 'Enter']">
    	<template slot="tag" slot-scope="props">
			<span class="mentor-tag bg-color-primary-1 text-white">
	    		{{ props.option.name }}
	    		<span class="tag-remove" @click="props.remove(props.option)">
	    			<i class="fas fa-times-circle"></i>
	    		</span>
	    	</span>
		</template>
		<template slot="noResult">
			Kein Ergebnis. Ändere den Suchbegriff!
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
			}
		},
		data() {
			return {
				value: this.selected
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