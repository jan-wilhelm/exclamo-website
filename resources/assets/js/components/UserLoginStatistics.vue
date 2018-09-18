<template>
	<div>
		<apexcharts
			:height="chartHeight"
			:class="('statistic-' + variant)"
			type="area"
			:options="chartOptions"
			:series="series"
			id="vuechart-example"
		>
		</apexcharts>
	</div>
</template>

<script>
	import VueApexCharts from 'vue-apexcharts'

	export default {
		props: {
			variant: {
				type: String,
				default: ""
			},
			chartData: {
				default() {
					return []
				}
			}
		},
		components: {
			apexcharts: VueApexCharts,
		},
		data () {
			return {
	        	chartOptions: {
					chart: {
						toolbar: {
							show: false
						}
					},
					xaxis: {
						type: 'datetime'
					},
		            dataLabels: {
		                enabled: false
		            },
		            stroke: {
		                curve: 'straight'
		            },
		            grid: {
		            	show: false
		            }
				},
				series: [{
					name: Vue.prototype.lang('messages.user_logins'),
					data: this.chartData
				}]
			}
		},
		computed: {
			chartHeight() {
				if (this.variant == "small") {
					return 200
				}
				return 'auto'
			}
		},
		methods: {
		}
	}
</script>

<style>

	.statistic-small > div {
		height: 200px !important;
	}
</style>