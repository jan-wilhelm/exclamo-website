<template>
	<div class="chat-message p-3" :class="[(sentByUser ? 'align-self-end right' : 'left'), (sending ? 'sending' : '')]">
		<a v-if="!sentByUser" class="mb-2 d-block">
			{{ anonymous ? "Anonymous user" : user.first_name + " " + user.last_name}}
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
			messageObject: Object
		},
		data() {
			return {
				body: this.messageObject.body,
				sentByUser: this.messageObject.sentByUser,
				date: this.messageObject.date,
				user: this.messageObject.user,
				sending: this.messageObject.sending,
				anonymous: this.messageObject.anonymous,
			}
		}
	};
</script>

<style scoped>
	.sending {
		opacity: 0.5;
	}
</style>