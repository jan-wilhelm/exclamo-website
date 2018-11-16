<template>
	<div>
		<h5 class="pl-2 pr-2 pt-2 font-weight-bold pb-0 mb-0">Logins an Ihrer Schule</h5>
		<canvas ref="canvas" :width="chartWidth" :height="chartHeight"></canvas>
	</div>
</template>

<script>
	import { Line } from 'vue-chartjs'

	export default {
		props: {
			variant: {
				type: String,
				default: ""
			},
			chartData: Array,
			chartWidth: {
				default: 600
			},
			chartHeight: {
				default: 400
			}
		},
		data() {
			return {
				dataForChart: {
					datasets: [
						{
							label: false,
							backgroundColor: 'rgba(0,0,0,0)',
				            data: this.filledChartData(),
							lineTension: 0.2,
							borderColor: 'rgb(0,149,138)',
							borderWidth: 4,
							pointStyle: false
						}
					]
				},
				options: {
					elements: {
						point: {
							hitRadius: 15,
							hoverRadius: 3,
							radius: 0
						}
					},
					legend: {
						display: false
					},
		            scales: {
		                yAxes: [{
			            	display: false,
		                    ticks: {
		                        beginAtZero: true
		                    }
		                }],
			            xAxes: [{
			            	display: false,
			                type: 'time',
			                time: {
			                    displayFormats: {day:'MMM D'
			                    }
			                },
			                distribution: 'linear'
			            }]
		            }
				}
			}
		},
		extends: Line,
		mounted () {
			// Overwriting base render method with actual data.
			this.renderChart(this.dataForChart, this.options)
		},
		methods: {
			filledChartData() {
				let data = this.chartData.sort((a,b) => a.x - b.x)
				console.log(data);
				return data
			}
		}
	}
</script>

<style>
</style>