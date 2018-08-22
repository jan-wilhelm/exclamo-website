<template>
	<div class="chat-message p-3" :class="[(messageObject.sentByUser ? 'align-self-end right' : 'left'), (messageObject.sending ? 'sending' : '')]">
		<a v-if="!messageObject.anonymous && !messageObject.sentByUser" class="mb-2 d-block">
			{{ messageObject.user.first_name + " " + messageObject.user.last_name}}
		</a>
		<span class="chat-text">
			{{ messageObject.body }}
		</span>
		<span class="chat-time">
			{{ messageObject.date }}
		</span>
	</div>
</template>

<script>
	export default {
		props: {
			messageObject: Object
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