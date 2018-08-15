<template>
	<transition name="fade" v-on:after-enter="hasLoaded" appear v-if="!loaded">
    	<div ref="loader" class="loader"></div>
    </transition>
</template>

<script>
	export default {
		data() {
			return {
				loaded: false
			}
		},
		methods: {
			hasLoaded() {
				this.loaded = true;
			}
		}
	};
</script>

<style>
	.loader {
		position: fixed;
		height: 100%;
		width: 100%;
		background-color: #fff;
		z-index: 10000;
	}

	.fade-enter-active {
		transition: opacity 1s;
	}

	.fade-enter-to {
		opacity: 0;
	}

	.fade-enter {
		opacity: 1;
	}
</style>