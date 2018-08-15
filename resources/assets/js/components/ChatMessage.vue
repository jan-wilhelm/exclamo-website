<template>
	<div class="chat-message p-3" :class="[(sentByUser ? 'align-self-end right' : 'left'), (sending ? 'sending' : '')]">
		<a v-if="!sentByUser" class="mb-2 d-block">
			{{ user.first_name + " " + user.last_name}}
		</a>
		<span class="chat-text">
			{{ body }}
		</span>
		<span class="chat-time">
			{{ date }}
		</span>
	</div>
</template>

<script>
	export default {
		props: {
			body: String,
			sentByUser: Boolean,
			date: String,
			user: Object,
			sending: Boolean
		},
		data() {
			return {

			}
		}
	};
</script>

<style scoped>
	.sending {
		opacity: 0.5;
	}
</style>