<template>
	<div class="chat-message p-3"
		:class="[
			(sentByUser ? 'align-self-end right' : 'left'),
			(messageObject.sending ? 'sending' : '')
		]">
		<a v-if="!messageObject.anonymous && !sentByUser" class="mb-2 d-block">
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
		},
		computed: {
			userId: function () { return window.Exclamo.userId; },
			sentByUser: function() {
				return (
					this.messageObject.sentByUser ||
					(this.messageObject.user && this.messageObject.user.id && this.messageObject.user.id == this.userId)
					)
			}
		}
	};
</script>

<style scoped>
	.sending {
		opacity: 0.5;
	}
</style>